#===================================================
# Program Name : Color
# Author: Michael Vance
# I, Michael Vance, wrote this script as original work completed by me.
# Special Feature:  Added the ability to make custom games!
# Stores custom values in a file for custom guessing games.
#===================================================


$exit = 0;
$menu = 0;
while ($exit -eq 0){
    #Ask the user what they want to do
Write-Output '--------------------------'
Write-Output 'What would you like to do?'
Write-Output '1:Play'
Write-Output '2:Stats'
Write-Output '3:Clear Stats'
Write-Output '4:Color List'
Write-Output '5:Custom Games'
Write-Output '6:Exit'
Write-Output '--------------------------'
$menu = Read-Host -Prompt '>'
    switch ($menu) {
        1 { Write-Host 'Guess my color:'
            Write-Host 'Type hint for a hint'
            Write-Host 'Type guess to see what you have guessed recently'
            Write-Host 'Type exit to quit'
            $color = ([System.Enum]::getvalues([System.ConsoleColor]))
            $hidden = $color[(Get-Random -Maximum ($color.length - 1) -Minimum 0)]
            $play = $true;
            $tracker = 0;
             
            #Play the game!
            while($play){
                $guess = Read-Host
                $record += ,$guess
                switch ($guess){
                    $hidden {$tracker += 1
                            Write-Host "$hidden is the answer! It only took you $tracker tries!" -BackgroundColor White -ForegroundColor $hidden
                            Write-Output "Tries: $tracker, Color: $hidden, Date: $(Get-Date -Format g)" >> cStats.txt
                            Write-Output "Play again?"
                            $pAgain = Read-Host -Prompt "Y/N"
                                switch ($pAgain) {
                                    ('y') { $hidden = $color[(Get-Random -Maximum ($color.length - 1) -Minimum 0)]
                                            $tracker = 0
                                            Remove-Variable record
                                            break;}
                                    ('n') {$play = $false
                                            Remove-Variable record}
                                    Default {Write-Output 'Not a valid command'}
                                }
                            break;}
                    
                    ('hint') {Write-Output "$($hidden)"}
                    
                    ('exit') {Write-Host 'The Color was $hidden' -BackgroundColor Black -ForegroundColor Red
                            $play = $false
                            Remove-Variable record
                            break;}
                    
                    ('guess') {$record}
                    Default {Write-Output "No, try again."
                            [void]$tracker++}
                }
            }


        }
        2 { 
            #Check to see if the stats file exists
            $stats = Get-Content .\cStats.txt
            if($stats){Write-Output $stats}
            else{Write-Output 'There are no stats to display.'}
        }
        3 {Write-Output 'Are you sure?'
            $clearStats = Read-Host -Prompt 'Y/N'
            Switch ($clearStats){
                ('y') {Write-Output '' > cStats.txt
                     Write-Output 'Stats cleared.'
                    break;}
                ('n') {break;}
                Default {Write-Host 'Unknown Command: Returning to menu'; break;}    
            }
            
            }
        4 { Write-Output ([System.Enum]::getvalues([System.ConsoleColor])); break}
        
        #Create or play a custom game
        5 {$cMenu = $true
            while ($cMenu) {
            Write-Output '1: Create'
            Write-Output '2: Play'
            Write-Output '3: Exit'
            $menu = Read-Host    
                switch($menu){
                    
                    #Read and Store the values for the custom game
                    1 {Write-Host 'Enter the possible values to guess'
                        Write-Host 'Type done when finished' 
                         $create = $true
                         
                         while($create){
                            $cInput = Read-Host -Prompt '>'
                            switch($cInput){
                                ('done') {Write-Output $cArray > cust.txt
                                            $create = $false
                                            break;
                                            }
                                Default {$cArray += ,$cInput}
                            }}
                        }
                    
                    #Play the custom game
                    2 {
                    Write-Host 'Custom Game!'
                    Write-Host 'Type hint for a hint'
                    Write-Host 'Type guess to see what you have guessed recently'
                    Write-Host 'Type exit to quit'
                    $cRan = Get-Content .\cust.txt
                    $hidden = $cRan[(Get-Random -Maximum ($cRan.length - 1) -Minimum 0)]
                    $play = $true;
                    $tracker = 0;
                     
                    
                    while($play){
                        $guess = Read-Host
                        $record += ,$guess
                        switch ($guess){
                            $hidden {$tracker += 1
                                    Write-Host "$hidden is the answer! It only took you $tracker tries!"
                                    Write-Output "Custom Game. Tries: $tracker, $hidden, Date: $(Get-Date -Format g)" >> cStats.txt
                                    Write-Output "Play again?"
                                    $pAgain = Read-Host -Prompt "Y/N"
                                        switch ($pAgain) {
                                            ('y') { $hidden = $cRan[(Get-Random -Maximum ($cRan.length - 1) -Minimum 0)]
                                                    $tracker = 0
                                                    Remove-Variable record
                                                    break;}
                                            ('n') {$play = $false
                                                    Remove-Variable record}
                                            Default {Write-Output 'Not a valid command'}
                                        }
                                    break;}
                            
                            ('hint') {Write-Output "$($hidden)"}
                            
                            ('exit') {Write-Host "I was thinking of $hidden" -BackgroundColor Black -ForegroundColor Red
                                    $play = $false
                                    Remove-Variable record
                                    break;}
                            
                            ('guess') {$record}
                            Default {Write-Output "No, try again."
                                    [void]$tracker++}
                        }}}






                    3 {$cMenu = $false
                        break;}
                    Default{}
                }


            }
        }
        
        
        
        
        
        
        
        6 { $exit = 1; break}
        Default {
            Write-Output 'That is not a valid option.'
        }
    }

}