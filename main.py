from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, EmailStr
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

app = FastAPI()

class EmailRequest(BaseModel):
    to: EmailStr
    subject: str
    message: str

@app.post("/send-mail/")
def send_mail(email: EmailRequest):
    smtp_server = "smtp.yourdomain.com"
    smtp_port = 587
    sender_email = "your-email@yourdomain.com"
    sender_password = "your-email-password"

    try:
        msg = MIMEMultipart()
        msg['From'] = sender_email
        msg['To'] = email.to
        msg['Subject'] = email.subject
        msg.attach(MIMEText(email.message, 'plain'))

        server = smtplib.SMTP(smtp_server, smtp_port)
        server.starttls()
        server.login(sender_email, sender_password)
        server.sendmail(sender_email, email.to, msg.as_string())
        server.quit()

        return {"status": "Email sent successfully"}

    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Failed to send email: {e}")
