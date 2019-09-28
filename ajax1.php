<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dickenzoh</title>
</head>
<body>
    <div id="message"></div>

    <form id = 'getForm'>
        <input type = "text" name="mes">
        <input type = "submit" name="Search">
    </form>
    <script>
        //Create event listener
        document.getElementById('getForm').addEventListener('submit', getMessage);
        

        function getMessage(e){
            e.preventDefault();
            //Create the XHR Object
            var xhr = new XMLHttpRequest();
            //Open and get data
            xhr.open('POST', 'fetch.php', true);

            console.log('READYSTATE: ', xhr.readyState);
            
            xhr.onload = function(){
                console.log('SO GOOD');
                if(this.readyState == 4 && this.status == 200){ 
                    console.log('Connection OK');
                    var mess = JSON.parse(this.responseText); // Gorey iko hapa
                    console.log( mess );

                    var output =' ';

                    for(var i = 0; i < mess; i++){
                        output += '<tr><td>' + mess[i].message + '</tr></td>' ;
                    }
                    //console.log(this.responseText);
                    document.getElementById('message').innerHTML = output;
                }
                else if(this.status == 404 || this.readyState != 4){
                    document.getElementById('message').innerHTML = 'Not found';

                }
            }
            xhr.onerror = function(){
                console.log('Connection Failed');  
            }

            xhr.send();    
        }
    </script>

        
</body>
</html>