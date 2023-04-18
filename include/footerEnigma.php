<!DOCTYPE html>
<html>
    <head>
        <style>
            .buttonFooter {
                width:150px;
                height:50px;
                --b: 3px;
                --s: .45em;
                --color: white;
                
                padding: calc(.5em + var(--s)) calc(.9em + var(--s));
                color: var(--color);
                --_p: var(--s);
                background:
                    conic-gradient(from 90deg at var(--b) var(--b),#0000 90deg,var(--color) 0)
                    var(--_p) var(--_p)/calc(100% - var(--b) - 2*var(--_p)) calc(100% - var(--b) - 2*var(--_p));
                transition: .3s linear, color 0s, background-color 0s;
                outline: var(--b) solid #0000;
                outline-offset: .6em;
                font-size: 16px;

                border: 0;

                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
            }

            .buttonFooter:hover,
            .buttonFooter:focus-visible{
                --_p: 0px;
                outline-color: var(--color);
                outline-offset: .05em;
            }

            .buttonFooter:active {
                color: #fff;
            }

            #footerDiv{
                display:grid;
                
            }
        </style>
        
    </head>
    <footer>
        <div id="footerDiv">
            <form action="Enigma/difficulte.php" method="post">
                <input type="submit" value="Difficulté" name="difficulteButton" class="buttonFooter">
            </form> 
            <form>
                <input type="submit" value="Darquest" name="indexButton" class="buttonFooter">
            </form>
        </div>
    </footer>
</html>