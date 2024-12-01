
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entretien IA - Évaluation de Candidat</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --primary-color: #2563eb;
                --secondary-color: #1e40af;
                --background-color: #f3f4f6;
                --card-background: #ffffff;
                --text-color: #1f2937;
                --border-color: #e5e7eb;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --error-color: #ef4444;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background-color: var(--background-color);
                color: var(--text-color);
            }

            .container {
                max-width: 1000px;
                margin: 2rem auto;
                padding: 0 1rem;
            }

            .chat-container {
                background-color: var(--card-background);
                border-radius: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                overflow: hidden;
            }

            .chat-header {
                background-color: var(--primary-color);
                color: white;
                padding: 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .chat-header h1 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .progress-container {
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 0.5rem;
                padding: 0.5rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .progress-text {
                font-size: 0.875rem;
                white-space: nowrap;
            }

            .chat-messages {
                height: 500px;
                overflow-y: auto;
                padding: 1.5rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .message {
                max-width: 80%;
                padding: 1rem;
                border-radius: 0.75rem;
                position: relative;
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .message-ai {
                background-color: var(--primary-color);
                color: white;
                align-self: flex-start;
                border-bottom-left-radius: 0;
            }

            .message-user {
                background-color: var(--background-color);
                align-self: flex-end;
                border-bottom-right-radius: 0;
            }

            .message-evaluation {
                background-color: var(--success-color);
                color: white;
                align-self: center;
                width: 100%;
                text-align: center;
            }

            .chat-input {
                padding: 1.5rem;
                background-color: var(--card-background);
                border-top: 1px solid var(--border-color);
            }

            .input-container {
                display: flex;
                gap: 1rem;
            }

            .input-field {
                flex: 1;
                padding: 0.75rem 1rem;
                border: 2px solid var(--border-color);
                border-radius: 0.5rem;
                font-size: 1rem;
                transition: border-color 0.2s;
            }

            .input-field:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            }

            .submit-button {
                padding: 0.75rem 1.5rem;
                background-color: var(--primary-color);
                color: white;
                border: none;
                border-radius: 0.5rem;
                font-size: 1rem;
                cursor: pointer;
                transition: background-color 0.2s;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .submit-button:hover {
                background-color: var(--secondary-color);
            }

            .submit-button:disabled {
                background-color: var(--border-color);
                cursor: not-allowed;
            }

            .typing-indicator {
                display: flex;
                gap: 0.25rem;
                padding: 0.5rem;
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 1rem;
                margin-top: 0.5rem;
            }

            .typing-dot {
                width: 8px;
                height: 8px;
                background-color: white;
                border-radius: 50%;
                animation: typing 1s infinite ease-in-out;
            }

            .typing-dot:nth-child(1) { animation-delay: 0s; }
            .typing-dot:nth-child(2) { animation-delay: 0.2s; }
            .typing-dot:nth-child(3) { animation-delay: 0.4s; }

            @keyframes typing {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-5px); }
            }

            .score-badge {
                background-color: white;
                color: var(--primary-color);
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-weight: 600;
                margin-left: 0.5rem;
            }

            .final-score {
                background-color: var(--success-color);
                color: white;
                padding: 2rem;
                text-align: center;
                border-radius: 0.75rem;
                margin-top: 1rem;
            }

            .final-score h2 {
                margin: 0;
                font-size: 2rem;
            }

            .final-score p {
                margin: 0.5rem 0 0;
                opacity: 0.9;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="chat-container">
                <div class="chat-header">
                    <h1>Entretien IA - Évaluation</h1>
                    <div class="progress-container">
                        <span class="progress-text">Question <span id="currentQuestion">1</span>/5</span>
                    </div>
                </div>
                
                <div id="chatMessages" class="chat-messages">
                    <!-- Les messages seront ajoutés ici dynamiquement -->
                </div>

                <div class="chat-input">
                    <div class="input-container">
                        <input type="text" id="userInput" class="input-field" placeholder="Tapez votre réponse..." disabled>
                        <button id="submitButton" class="submit-button" disabled>
                            <i class="fas fa-paper-plane"></i>
                            <span>Envoyer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module">
        import { GoogleGenerativeAI } from "https://esm.run/@google/generative-ai";

        const API_KEY = "AIzaSyBYOAvxE6gNY-QzmdmatekdCShacikPccQ";
        const genAI = new GoogleGenerativeAI(API_KEY);
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

        let currentQuestionIndex = 0;
        let totalScore = 0;
        let isWaitingForAnswer = false;
        let prompt = <?php echo json_encode($prompt); ?>;

        const chatMessages = document.getElementById('chatMessages');
        const userInput = document.getElementById('userInput');
        const submitButton = document.getElementById('submitButton');
        const currentQuestionElement = document.getElementById('currentQuestion');

        async function addMessage(content, type = 'ai') {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message message-${type}`;
            messageDiv.textContent = content;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        async function generateQuestion() {
            try {
                userInput.disabled = true;
                submitButton.disabled = true;

                const questionPrompt = `${prompt}\nGénérer la question numéro ${currentQuestionIndex + 1} sur 5 de manière claire et concise.`;
                const result = await model.generateContent(questionPrompt);
                const question = result.response.text();

                addMessage(question, 'ai');
                currentQuestionElement.textContent = currentQuestionIndex + 1;

                userInput.disabled = false;
                submitButton.disabled = false;
                isWaitingForAnswer = true;

                return question;
            } catch (error) {
                console.error('Erreur lors de la génération de la question:', error);
                addMessage('Désolé, une erreur est survenue lors de la génération de la question.', 'error');
            }
        }

        async function evaluateAnswer(answer, questionContext) {
            try {
                const evaluationPrompt = `
                    Contexte de la question: ${questionContext}
                    Réponse du candidat: "${answer}"
                    
                    Évaluez cette réponse sur 20 points selon ces critères:
                    - Pertinence (8 points)
                    - Clarté (6 points)
                    - Détails (6 points)
                    
                    Donnez une note sur 20 et une brève justification.
                `;

                const result = await model.generateContent(evaluationPrompt);
                const evaluation = result.response.text();
                const score = parseInt(evaluation.match(/\d+/)[0]);

                addMessage(`${evaluation}\nScore: ${score}/20`, 'evaluation');
                return score;
            } catch (error) {
                console.error('Erreur lors de l\'évaluation:', error);
                addMessage('Erreur lors de l\'évaluation de la réponse.', 'error');
                return 0;
            }
        }

        async function handleSubmit() {
            if (!isWaitingForAnswer || !userInput.value.trim()) return;

            const answer = userInput.value.trim();
            userInput.value = '';
            userInput.disabled = true;
            submitButton.disabled = true;
            isWaitingForAnswer = false;

            addMessage(answer, 'user');

            const score = await evaluateAnswer(answer, chatMessages.lastElementChild.textContent);
            totalScore += score;

            currentQuestionIndex++;

            if (currentQuestionIndex < 5) {
                await generateQuestion();
            } else {
                const finalScore = Math.round((totalScore / 100) * 100);
                const finalScoreDiv = document.createElement('div');
                finalScoreDiv.className = 'final-score';
                finalScoreDiv.innerHTML = `
                    <h2>Évaluation terminée</h2>
                    <p>Score final: ${finalScore}/100</p>
                `;
                chatMessages.appendChild(finalScoreDiv);
                userInput.disabled = true;
                submitButton.disabled = true;

                // Appeler la fonction complete_test via AJAX
                $.ajax({
                    url: '<?= site_url('ChatbotController/complete_test'); ?>',  // URL vers la méthode complete_test
                    method: 'POST',
                    data: {
                        total_score: finalScore,  // Passer le score final
                        commentaire: 'Test completé avec succès'  // Commentaire optionnel
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Les résultats ont été soumis avec succès !');
                        } else {
                            alert('Erreur lors de la soumission des résultats.');
                        }
                    },
                    error: function() {
                        alert('Erreur AJAX');
                    }
                });
            }
        }

        // Event Listeners
        submitButton.addEventListener('click', handleSubmit);
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') handleSubmit();
        });

        // Démarrer avec la première question
        generateQuestion();
    </script>

    </body>
    </html>