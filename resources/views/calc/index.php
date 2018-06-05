<head>
    <meta charset="utf-8">
    <title>Calculator</title>
</head>
<body>
<form method="post" attribute="post" action="result.php">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p>First Value:<br/>
        <input type="text" id="first" name="first"></p>
    <p>Second Value:<br/>
        <input type="text" id="second" name="second"></p>
    <p><input type="radio" name="group1" id="add" value="add" checked="true">+</p>
    <p><input type="radio" name="group1" id="subtract" value="subtract">-</p>
    <p><input type="radio" name="group1" id="times" value="times">x</p>
    <p><input type="radio" name="group1" id="divide" value="divide">/</p>
    <p></p>
    <button type="submit" name="answer" id="answer" value="answer">Calculate</button>
</form>
</body>
</html>