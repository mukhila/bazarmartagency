<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .email-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(-50px) translateY(-50px); }
            100% { transform: translateX(50px) translateY(50px); }
        }

        .email-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .email-icon svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        .email-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .email-subtitle {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .email-content {
            padding: 40px 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .field-container {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #4f46e5;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .field-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 49%, rgba(79, 70, 229, 0.02) 50%, transparent 51%);
            pointer-events: none;
        }

        .field-container:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .field-label {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .field-icon {
            width: 16px;
            height: 16px;
            opacity: 0.7;
        }

        .field-value {
            color: #475569;
            font-size: 16px;
            line-height: 1.5;
            word-wrap: break-word;
        }

        .message-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .message-container::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 60px;
            color: #cbd5e1;
            font-family: serif;
        }

        .message-text {
            color: #334155;
            font-size: 16px;
            line-height: 1.7;
            font-style: italic;
            position: relative;
            z-index: 1;
        }

        .email-footer {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer-text {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .timestamp {
            color: #94a3b8;
            font-size: 12px;
            font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
        }

        .priority-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-left: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            body {
                padding: 10px;
            }

            .email-header {
                padding: 30px 20px;
            }

            .email-title {
                font-size: 24px;
            }

            .email-content {
                padding: 30px 20px;
            }

            .field-container {
                padding: 16px;
            }

            .message-container {
                padding: 20px;
            }
        }

        /* Dark mode support for email clients that support it */
        @media (prefers-color-scheme: dark) {
            .email-container {
                background: #1e293b;
            }

            .field-container {
                background: #334155;
                color: #e2e8f0;
            }

            .field-label {
                color: #f1f5f9;
            }

            .field-value {
                color: #cbd5e1;
            }

            .message-container {
                background: #334155;
                border-color: #475569;
            }

            .message-text {
                color: #e2e8f0;
            }

            .email-footer {
                background: #334155;
                border-color: #475569;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="email-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
            </div>
            <h1 class="email-title">New Contact Inquiry</h1>
            <p class="email-subtitle">You have received a new message from your website</p>
        </div>

        <div class="email-content">
            <div class="form-section">
                <div class="field-container">
                    <div class="field-label">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        Full Name
                    </div>
                    <div class="field-value">{{ $name }}</div>
                </div>

                <div class="field-container">
                    <div class="field-label">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        Email Address
                    </div>
                    <div class="field-value">{{ $email }}</div>
                </div>

                <div class="field-container">
                    <div class="field-label">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Subject
                        <span class="priority-badge">New</span>
                    </div>
                    <div class="field-value">{{ $subject }}</div>
                </div>

                <div class="field-container">
                    <div class="field-label">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                        </svg>
                        Message
                    </div>
                    <div class="message-container">
                        <div class="message-text">{{ $message }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="email-footer">
            <p class="footer-text">This message was sent from your website's contact form</p>
            <p class="timestamp" id="timestamp">Received on: Loading...</p>
        </div>
    </div>

    <script>
        // Add current timestamp
        document.getElementById('timestamp').textContent = 
            'Received on: ' + new Date().toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
    </script>
</body>
</html>