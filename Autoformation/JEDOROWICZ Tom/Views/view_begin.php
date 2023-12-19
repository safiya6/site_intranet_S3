<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Films</title>
    <style>
  body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("https://wallpapercave.com/wp/wp3160266.jpg");
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: auto;
        }

      nav {
          grid-area: menu;
          margin-bottom: 20px; /* créer un espace entre la nav barre et le formulaire */
          }

      form {
          max-width: 400px;
          margin: 20px auto;
          background: #7b6d71;
          padding: 35px;
          border-radius: 40px;
          justify-content: center ; 
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }


        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #111;
        }

        input[type="submit"] {
            border: none;
            color: #black;
            cursor: pointer;
            padding: 25px;
            font-size: 20px;
        }

        input[type="submit"]:hover {
            background-color: #white;
          }
nav ul { margin:10;  padding:0;}
nav li {  list-style-type : none; padding : 0px; margin-bottom : 50px; }
nav li a { display : block; margin : 0; background-color : #C9C9D9; border-radius : 10px; padding-top : 20px; padding-bottom : 35px; padding-left : 10px; padding-right : 10px; width:100%; vertical-align : middle; text-align : center; text-decoration : none; color : #686887; font-style : italic; }

}

nav ul{

	display: flex;

}
nav li {display: inline-block; margin: 2em;}

.sansBordure { border : 0px; width : 30px; padding-left : 0px;}

table { border-collapse : collapse; margin : auto; }
td,th { border : 1px solid black;  width : 300px; height : 30px; text-align : center;}

main {
    background-color: #999;
    border-radius: 20px;
    padding: 40px;
    position: relative;
    grid-area: main;
    margin-top: 50px; /* Ajout de la marge supérieure */
}

    </style>
</head>
<body>
<nav>
			<ul>
				<li><a href="?controller=Create&action=default"> Ajouter un Film</a></li>
				<li><a href="?controller=Update&action=default"> Update un Film</a></li>
				<li><a href="?controller=liste&action=default"> Afficher les Films</a></li>
				<li><a href="?controller=Delete&action=default"> Supprimer un Film</a></li>
			</ul>
		</nav>
