var terminalForm = document.querySelector('.terminal-form');
terminalForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var input = document.querySelector('#command');
    var inputValue = input.value;
    inputValue.trim();
    inputValue.toLowerCase();
    var commandName = inputValue;
    // faire une fct runCommand(inputValue) ligne 8 à 20;
    if (inputValue.indexOf(' ')) {
        var commands = inputValue.split(/\s/);
        if (commands.length > 2) {
            commandsFunctions.terminalText.innerHTML += '<p class="error">La commande ' + '"<i>' + commandName + '</i>"' + ' n\'existe pas.</p>'; // faire un système alert()
            return;
        }
        commandName = commands[0];
        var param = commands[1];
    }
    input.value = ''; // faire une fct terminal.clear()
    if (!(commandName in commandsList)) {
        commandsFunctions.terminalText.innerHTML += '<p class="error">La commande ' + '"<i>' + commandName + '</i>"' + ' n\'existe pas.</p>';
        return;
    }
    var functionToRun = commandsList[commandName];
    functionToRun(param);
});