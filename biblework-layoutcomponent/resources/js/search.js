function searchFn() {
    var search = document.getElementById("term").value;
    console.log(search);
    alert(search);
    //document.getElementById("display").innerHTML = search;
    return true;
}
function getNames(obj, name) {
    var result = [];
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            if ("object" == typeof(obj[key])) {
                result = result.concat(getNames(obj[key], name));
            } else if (key == name) {
                result.push(obj[key]);
            }
        }
    }
    return result;
}