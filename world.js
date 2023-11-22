window.onload = click;

var data;

function click(){
    
    document.getElementById("lookup").addEventListener("click", getCountry);
    document.getElementById("lookup_cities").addEventListener("click", getcities);
}

function getCountry(){
    data = document.getElementById("country").value;
    
    fetch("world.php?country=" +data)
    .then(a => a.text())
    .then(x=>{
        document.getElementById("result").innerHTML = x;
    })
}

function getcities(){
    data = document.getElementById("country").value;
    
    fetch("world.php?country="+data+"&Lookup=cities")
    .then(a => a.text())
    .then(x=>{
        document.getElementById("result").innerHTML = x;
    })
}