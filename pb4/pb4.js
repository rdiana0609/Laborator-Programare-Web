let board = ["-", "-", "-", "-", "-", "-", "-", "-", "-"];
if (Math.floor(Math.random() * 2) === 1) sendToServer("---------");
let restartBtn = document.getElementById('restartBtn')
let boxes = Array.from(document.getElementsByClassName('box'))
let spaces = Array(9).fill(null)


function put(cell) {
    cell.innerHTML = 'X';
    board[cell.id - 1] = 'X';
    console.log(board.join(""));
    sendToServer(board.join(""));
}
restartBtn.addEventListener('click', restart)

function restart() {
    spaces.fill(null)

    boxes.forEach( box => {
        box.innerText = ''
        box.style.backgroundColor=''
    })

    //playerText.innerHTML = 'Tic Tac Toe'
    let board = ["-", "-", "-", "-", "-", "-", "-", "-", "-"];
    if (Math.floor(Math.random() * 2) === 1) sendToServer("---------");
    
}

function sendToServer(str) {
   
    if (str === '') {
        window.alert('Eroare in sendToServer - str e gol');
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === 'wx') {
                document.getElementById('result').innerHTML = 'X WINS!';
            } else if (this.responseText === 'wo') {
                document.getElementById('result').innerHTML = 'O WINS!';
            } else if (this.responseText === 'wr') {
                document.getElementById('result').innerHTML = 'DRAW!';
            } else {
                console.log('response index', this.responseText);
                console.log('sdasda', str);
                document.getElementById((parseInt(this.responseText) + 1).toString()).innerHTML = "O";
                let response = parseInt(this.responseText);
                board[response] = "O";
                console.log(response - 1);
                console.log(board.join(""));
            }
        }
    };
    xhttp.open("GET", "http://localhost/pb4/pb4.php?arr=" + str, true);
    xhttp.send(null);
}