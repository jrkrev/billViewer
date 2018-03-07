<?php
// This script contains the functions to create the title and navigation bars.

function CreateTitleBar()
{
    echo "<div class =\"title\">billViewer - view, add, delete bills.</div>";
}

function CreateNavigationBar()
{
    echo    "<div class = \"navigation\">
                <a href =\"./index.php\">Home</a>
                <a href =\"./view.php\">View</a>
                <a href = \"./add.php\">Add</a>
                <a href = \"./delete.php\">Delete</a>             
            </div>";
}