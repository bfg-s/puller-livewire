if (!window.Puller) {
    throw "This extension must be initialized after Puller.";
} else if (!window.Livewire) {
    throw "This extension must be initialized after Livewire.";
}

let oldMessage = window.Livewire.connection.onMessage;
window.Livewire.connection.onMessage = function (message, payload) {
    oldMessage(message, payload);
    if (!payload.puller)
        throw "Plugin error";
    window.Puller.response(payload.puller);
};
window.Livewire.connection.headers['Puller-KeepAlive'] = window.Puller.tab();
window.Livewire.connection.headers['Puller-Message'] = window.Puller.tab();

window.Puller.channel('livewire', ({name, detail}) => {
    window.Livewire.emit(`puller:${name}`, detail);
});
