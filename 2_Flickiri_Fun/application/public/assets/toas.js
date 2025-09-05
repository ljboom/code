function message(msg, type) {
    if (!msg) return;
    const body = document.body;
    const messageBox = document.createElement("div");

    messageBox.style.position = 'fixed';
    messageBox.style.top = '0px';
    messageBox.style.left = '0px';
    messageBox.style.right = '0px';
    messageBox.style.zIndex = 999;
    messageBox.style.fontSize = '14px';
    messageBox.style.height = '100vh';
    messageBox.style.display = 'flex';
    messageBox.style.justifyContent = 'center';
    messageBox.style.alignItems = 'center';
    const message = document.createElement("div");
    switch (type || '') {
        case 'success':
            const success = document.createElement("div");
            const successBox = document.createElement("div");
            success.className = 'success-icon'

            successBox.style.padding = '10px 17px';
            successBox.style.borderRadius = '8px';
            successBox.style.background = '#fff';
            successBox.style.color = 'black';
            successBox.append(success)
            successBox.append(message)
            messageBox.append(successBox);

            message.innerHTML = msg;
            break;
        case 'error':
            message.style.width = '70px';
            message.style.margin = '60% auto';
            message.style.padding = '3px 6px';
            message.style.border = '1px solid #ffff';
            message.style.borderRadius = '5px';
            message.style.background = '#fff';
            message.style.color = 'black';
            message.style.textAlign = 'center';
            break;
        default:
            message.style.padding = '10px 17px';
            message.style.borderRadius = '8px';
            message.style.background = '#ffff';
            message.style.color = 'black';
            message.innerHTML = msg;
            messageBox.append(message);
    }

    body.append(messageBox);
    setTimeout(() => {
        messageBox.remove();
    }, 2000);
}
