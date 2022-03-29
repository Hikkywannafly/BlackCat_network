let key = 'on';
let key1 = 'on';
function update() {

    if (key == 'on') {
        key = 'off';
        console.log("on");
        return document.getElementById('form_update').hidden = false;
    }
    if (key == 'off') {
        key = 'on';
        console.log("off");
        return document.getElementById('form_update').hidden = true;;
    }
}

function remove() {
    if (key1 == 'on') {
    key1 = 'off';
    console.log("on");
    return document.getElementById('form_remove').hidden = false;
}
if (key1 == 'off') {
    key1 = 'on';
    console.log("off");
    return document.getElementById('form_remove').hidden = true;
}
}