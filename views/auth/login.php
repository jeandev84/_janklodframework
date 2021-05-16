<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
         /*div.form__input {*/
         /*    border: 1px solid #ccc;*/
         /*}*/

         div.form__input input {
             display: block;
             width: 50%;
             border: 1px solid #ccc;
             border-radius: 3px;
             height: 30px;
             margin-bottom: 3px;
         }
    </style>
</head>
<body>
<!--   <div>-->
<!--       Hi, <strong>--><?//= $username ?><!--</strong>. You logged in from email <b>--><?//= $email ?><!--</b>-->
<!--   </div>-->

   <h1>Вход</h1>
   <div class="container">
       <form action="/auth/login" method="post">
           <div class="form__input">
               <input type="text" name="email" placeholder="jeanyao@ymail.com">
           </div>
           <div class="form__input">
               <input type="password" name="password" placeholder="Qwerty!">
           </div>
           <div style="margin-top: 9px;">
               <button type="submit">Войти</button>
           </div>
       </form>
   </div>
</body>
</html>