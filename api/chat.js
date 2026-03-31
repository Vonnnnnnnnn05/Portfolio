export default async function handler(req, res) {
  const deploymentEnvironment =
    process.env.VERCEL_ENV || process.env.NODE_ENV || 'unknown';
  const hasGroqApiKey = Boolean(process.env.GROQ_API_KEY);

  if (req.method === 'GET') {
    return res.status(200).json({
      ok: true,
      route: '/api/chat',
      environment: deploymentEnvironment,
      hasGroqApiKey,
      timestamp: new Date().toISOString(),
    });
  }

  if (req.method !== 'POST') {
    res.setHeader('Allow', 'GET, POST');
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const groqApiKey = process.env.GROQ_API_KEY;

  if (!groqApiKey) {
    return res.status(500).json({
      error: 'Missing GROQ_API_KEY on the server.',
      environment: deploymentEnvironment,
      hasGroqApiKey,
    });
  }

  try {
    const { message, systemPrompt } = req.body ?? {};

    if (!message || typeof message !== 'string') {
      return res.status(400).json({ error: 'Message is required.' });
    }

    const response = await fetch('https://api.groq.com/openai/v1/chat/completions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${groqApiKey}`,
      },
      body: JSON.stringify({
        model: 'llama-3.1-8b-instant',
        messages: [
          ...(systemPrompt ? [{ role: 'system', content: systemPrompt }] : []),
          { role: 'user', content: message },
        ],
        temperature: 0.7,
        max_tokens: 256,
      }),
    });

    const data = await response.json();

    if (!response.ok) {
      return res.status(response.status).json({
        error: data?.error?.message || 'Groq request failed.',
      });
    }

    return res.status(200).json({
      reply: data?.choices?.[0]?.message?.content || 'No response generated.',
    });
  } catch (error) {
    return res.status(500).json({
      error: error instanceof Error ? error.message : 'Unexpected server error.',
    });
  }
}
