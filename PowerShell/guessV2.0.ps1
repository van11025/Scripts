<#================================================
||   Guessing Game Version 2.0
||   Coded and Authored by Michael Vance
||   Pick A random number between 1 and 100
||   Have the user make a guess, then tell them
||   if they are right. If wrong, tell them if     
||   it is bigger or smaller.
================================================#>


Write-Host 'Guessing Game! V2.0' -BackgroundColor Black -ForegroundColor White
Write-Host 'Author: Mike Vance' -BackgroundColor Black -ForegroundColor White


#Create a loop to contain the game menu

$menu = $true;
while($menu){
    #Ask the user what action to take.
    Write-Host '---------------------------'
    Write-Host 'What would you like to do?'
    Write-Host 'Play: Play the game!'
    Write-Host 'Exit: Quit the program.'
    Write-Host '---------------------------'
    $mAction = Read-Host -Prompt '>';
    #Create a switch statement to filter input and take action
    switch($mAction){
        ('play'){
            #Create the guessing game.
            #First, pick and store a random number between 1 and 100.
            $rand = Get-Random -Maximum 100 -Minimum 1;
            $play = $true;
            $guess = 0;
            $tries = 0
            $parseVal = 0;
            Write-Host 'I have picked a number between 1 and 100.'

            while($play){
            #Read the user value
            $guess = Read-Host -Prompt "$tries"
            if($guess -eq 'exit'){Write-Host "My number was $rand";$play = $false;continue;}

                #Make sure the value is a number!
                $isnum = [int32]::TryParse($guess, [ref]$parseVal)
                if($isnum){
                    if($guess -eq $rand){Write-Host "My number was $rand!";$play = $false;}
                    elseif($guess -gt $rand){Write-Host "My number is Smaller.";$tries++;}
                    elseif($guess -lt $rand){Write-Host "My number is Bigger.";$tries++}
                }
                else{Write-Host 'That is not a number'}
            }
        #End of Play    
        }



        ('exit'){
            Write-Host 'Goodbye!';
            Exit;}

        Default{
        Write-Host 'Unknown Command.';}
        
        #End of Switch
    }
#End of Menu
}