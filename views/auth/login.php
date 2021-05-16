<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--   <div>-->
<!--       Hi, <strong>--><?//= $username ?><!--</strong>. You logged in from email <b>--><?//= $email ?><!--</b>-->
<!--   </div>-->

   <h1>Вход</h1>
   <div class="container">
       <form action="/auth/login" method="post">
           <div>
               <input type="text" name="email" placeholder="jeanyao@ymail.com">
           </div>
           <div>
               <input type="password" name="password" placeholder="Qwerty!">
           </div>
           <p><button type="submit">Send</button></p>
       </form>
   </div>
</body>
</html>