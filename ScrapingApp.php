<!DOCTYPE html>
<html>
<head>
<style> 
        body 
        {
            background-color: #1a1a1a;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        iframe 
        {
            width: 100%;
            height: 100%;
            border: none;
        }
        .form_div
        {
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }
        .frame_div
        {
            width: 100%;
            height: 600px;
            display: flex;
        }
        .submit_button
        {
            width: 75px;
            height: 20px;
            background-color: #0f0f0f;
            border-radius: 30px;
            border: none;
        }
    </style>
    <title>Web Scraper</title>
</head>
<body>
    <div class="form_div">
    <form method="post" action="search.php" target="display">
        <label for="site">Website:</label>
        <select name="site" id="siteln">
        <option value="">Choose a website:</option>
        <option id="google">Google</option>
        </select><br><br>
        <label for="site_params">Parameters:</label>
        <select name="site_params" id="site_params">
        <option value="">Choose a type</option>
        <option value="0">Videos</option>
        <option value="1">News</option>
        <option value="2">Shopping</option>
        </select><br><br>
        <label for="search" id="input_label">Search query: </label>
        <input type="text" name="search" id="search_input"><br><br>
        <label for="page_num" id="pagenum">Number of pages: </label>
        <input type="text" name="page_num" id="page_num"><br><br>
        <button class="submit_button" type="submit">Search!</button>
    </form>
    </div>
        <br><br>
    <div class="frame_div">
    <iframe name="display" frameborder="0"></iframe>
    </div>
<br><br><br>
</body>
</html>