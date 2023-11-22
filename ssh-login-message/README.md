

![image](https://github.com/A3is/LinuxCode/assets/122292323/5147f478-358a-47ab-b82e-82b3ab48566f)


Open the user's ~/.bashrc or ~/.bash_profile file using a text editor:
```bash
nano ~/.bashrc
```
OR
```bash
nano ~/.bash_profile
```
Add the following lines at the end of the file:
```bash
# Send Telegram message on SSH login
if [ -n "$SSH_CONNECTION" ]; then
    TELEGRAM_BOT_TOKEN="YOUR_BOT_TOKEN"
    TELEGRAM_CHAT_ID="YOUR_CHAT_ID"

    USER_IP=$(echo $SSH_CONNECTION | awk '{print $1}')
    DATE=$(TZ='Asia/Tehran' date +'%F %T')
    SERVER_NAME=$(hostname)
    SERVER_IP=$(hostname -I | awk '{print $1}')

    MESSAGE="User \"$USER\" logged in to SSH from IP \"$USER_IP\" at \"$DATE\" on server \"$SERVER_NAME\" (IP: $SERVER_IP)."

    curl -s -X POST https://api.telegram.org/bot$TELEGRAM_BOT_TOKEN/sendMessage -d chat_id=$TELEGRAM_CHAT_ID -d text="$MESSAGE" > /dev/null 2>&1
fi
```
Enter your real YOUR_BOT_TOKEN and YOUR_CHAT_ID.

Save the file and exit the text editor.
