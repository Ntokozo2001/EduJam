<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>WSP ChatBot</title>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
		<style>
			#response {
				margin-top: 20px;
				padding: 10px;
				min-height: 50px;
			}
			#response h3 {
				color: #333;
				font-size: 1.2em;
			}
			#response strong {
				color: #d9534f;
			}
			#response ul {
				padding-left: 20px;
			}
			#response li {
				margin-bottom: 5px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h2>Free ChatBot</h2>
			<div class="form-group">
				<input
					type="text"
					class="form-control"
					id="userInput"
					placeholder="Enter your question" />
			</div>
			<button class="btn btn-success" onclick="sendMessage()">Ask!</button>
			<div id="response"></div>
		</div>
		<script>
			import { Groq } from 'groq-sdk';

const groq = new Groq();

const chatCompletion = await groq.chat.completions.create({
  "messages": [
    {
      "role": "user",
      "content": ""
    }
  ],
  "model": "meta-llama/llama-4-scout-17b-16e-instruct",
  "temperature": 1,
  "max_completion_tokens": 1024,
  "top_p": 1,
  "stream": true,
  "stop": null
});

for await (const chunk of chatCompletion) {
  process.stdout.write(chunk.choices[0]?.delta?.content || '');
}

            async function sendMessage() {
                const userInput = document.getElementById('userInput').value;
                if (!userInput.trim()) {
                    alert('Please enter a question.');
                    return;
                }

                const responseDiv = document.getElementById('response');
                responseDiv.innerHTML = 'Loading...';

                try {
                    const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer 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',
                            'HTTP-Referer': 'https://www.jammarket.co.za',
                            'X-Title': 'examgen'
                        },
                        body: JSON.stringify({
                            model: 'meta-llama/llama-4-scout-17b-16e-instruct',
                            messages: [{ role: 'user', content: userInput }],
                            max_tokens: 2048,
                            temperature: 0.7
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    const content = data.choices[0].message.content;

                    responseDiv.innerHTML = marked(content);
                } catch (error) {
                    console.error('Error:', error);
                    responseDiv.innerHTML = '<strong>Error generating response.</strong>';
                }
            }

            </script>