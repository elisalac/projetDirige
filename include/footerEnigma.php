<!DOCTYPE html>
<html>
    <head>
        <style>
            footer{
                position:absolute;
                bottom:20px;
                left:42vw;
                height:100px;
            }
            

            #footerDiv{
                width:50%;
                display:grid;
                grid-template-columns: 1fr 1fr;
                grid-column-gap: 50px;
                text-align: center;
                margin-top: 0;
            }
        </style>
        
    </head>
    <footer>
        <div id="footerDiv">
            <form action="choix_difficulte.php" method="post">
                <input type="submit" value="Difficulté" name="difficulteButton" class="buttonFooter">
            </form> 
            <form action="../index.php" method="post">
                <input type="submit" value="Darquest" name="indexButton" class="buttonFooter">
            </form>
        </div>
    </footer>
</html>