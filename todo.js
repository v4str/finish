window.onload = giveMeTasks();
function add()
{
    var tmp = document.getElementById('l2').value;
    var params = 'addMessage=' + tmp;
    ajaxPost('del.php',params).then(resolve =>
    {
        let li = document.createElement('li');
        li.innerHTML = tmp;
        document.getElementById('task').appendChild(li);
        document.getElementById('l2').value = " ";
    }).catch(reject =>
    {
        alert(reject);
    })
}


function ajaxPost(url, params)
{
    return new Promise(function(resolve, reject)
    {
        var request = new XMLHttpRequest();
        request.open('POST',url,true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        request.addEventListener("load", function()
        {
            if(request.readyState == 4)
            {
                resolve(request.responseText);
            }
            else
            {
                reject(Error("Ошибка получения данных"));
            }
        });
        request.send(params);
    });
}

function giveMeTasks(){
    ajaxPost('add_all.php', "add_all").then(resolve=>{
        let body = document.getElementById('task');
        resolve = JSON.parse(resolve);
        for(let i = 0; i < resolve.length / 2; i++){
            let li = document.createElement('li');
            li.innerHTML = resolve[i * 2 + 1];
            li.onclick = ()=>{
                let answer = confirm("Желаете ли вы удалить этот таск?");
                if(answer){
                    let id = resolve[i * 2];
                    let params = `id=${id}`;
                    ajaxPost('delete.php', params).then(resolve=>{
                        window.location.reload();
                    })
                }else return;
            };
            body.appendChild(li);
        }
    })
}