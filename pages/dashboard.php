<!DOCTYPE html>
<html>

<head>
    <title>
        Creating Search Bar using HTML
        CSS and Javascript
    </title>

    <!-- linking the stylesheet(CSS) -->
    <style>
        #searchbar{
            margin-left: 15%;
            padding:15px;
            border-radius: 10px;
        }

        input[type=text] {
            width: 30%;
            -webkit-transition: width 0.15s ease-in-out;
            transition: width 0.15s ease-in-out;
        }

        /* When the input field gets focus,
             change its width to 100% */
        input[type=text]:focus {
            width: 70%;
        }


        .animals{
            display: flex;
        }
    </style>
</head>

<body>

<!-- input tag -->
<input id="searchbar" onkeyup="search_animal()" type="text"
       name="search" placeholder="Search animals..">

<!-- ordered list -->
<table border="1">
    <thead>
    <tr>
        <th >animals</th>
        <th >desc</th>
    </tr>
    </thead><tbody>
    <tr>
        <td class="animals">cat </td>
        <td class="animals">hhh</td>
    </tr>
    <tr>
        <td class="animals">dog </td>
        <td >aaa</td>

    </tr>
    <tr>
        <td class="animals">monkey </td>
        <td >ccc</td>

    </tr>
    <tr>
        <td class="animals">fish </td>
        <td >ddd</td>

    </tr>
    </tbody>
</table>
<ol >
    <li class="animals">Cat</li>
    <li class="animals">Dog</li>
    <li class="animals">Elephant</li>
    <li class="animals">Fish</li>
    <li class="animals">Gorilla</li>
    <li class="animals">Monkey</li>
    <li class="animals">Turtle</li>
    <li class="animals">Whale</li>
    <li class="animals">Aligator</li>
    <li class="animals">Donkey</li>
    <li class="animals">Horse</li>
</ol>

<!-- linking javascript -->
<script>
    function search_animal() {
        let input = document.getElementById('searchbar').value
        input=input.toLowerCase();
        let x = document.getElementsByClassName('animals');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display="none";
            }
            else {
                x[i].style.display="block";
            }
        }
    }
</script>
</body>

</html>