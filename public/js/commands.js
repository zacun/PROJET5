var terminalForm = document.querySelector('.terminal-form');
terminalForm.addEventListener('submit', function (e) {
    var input = document.querySelector('#command').value;
    input.trim();
    input.toLowerCase();
    if (input.indexOf(' ')) {
        var commands = input.split(/\s/);
        if (commands.length > 2) {
            commandsFunctions.terminalText.innerHTML += '<p class="error">La commande ' + '"<i>' + input + '</i>"' + ' n\'existe pas.</p>'
        } else {
            var index = commands[0];
            var param = commands[1];
            commandsList.command = commandsList[index];
            commandsList.command(param);
        }
    } else {
        commandsList.command = commandsList[input];
        commandsList.command();
    }
    e.preventDefault();
});