make me flappy bird game on vision os

<!DOCTYPE html>
<html>
<head>
    <title>Learning API in Web Coding</title>
</head>
<body>
    <h1>Using APIs in Web Coding</h1>
    <button onclick="fetchData()">Get Data</button>
    <div id="output"></div>

    <script>
        function fetchData() {
            fetch('https://jsonplaceholder.typicode.com/posts/1')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('output').innerHTML = `
                        <p>ID: ${data.id}</p>
                        <p>Title: ${data.title}</p>
                        <p>Body: ${data.body}</p>
                    `;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>