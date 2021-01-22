//  document.getElementById('searchByTags').addEventListener('click', function(e){
//     e.preventDefault();
//     var tagValue = document.getElementById('tags').value;
//     var xmlhttp = new XMLHttpRequest();
//     let donnees = {};
//     donnees["tagValue"] = tagValue;      
//     let donneesJson = JSON.stringify(donnees);
//     xmlhttp.open("POST", this.href);
//     xmlhttp.send(donneesJson);
//     var link = this.href;
//     setTimeout(showSearch(link), 100);
     
// })

// function showSearch(link){
//     var xmlhttp = new XMLHttpRequest();
//     document.getElementById('showProject').innerHTML = xmlhttp.responseText;
//     xmlhttp.open('GET', link, false);
//     xmlhttp.send();
// }