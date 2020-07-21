#playing around with using PowerShell to create a GUI for one of the guessing games

Add-Type -assembly System.Windows.Forms
$main_form = New-Object System.Windows.Forms.Form
$main_form.Text = 'Guessing Game'
$main_form.Width = 600
$main_form.Height = 600
$main_form.AutoSize = $true



$menuLabel = New-Object System.Windows.Forms.Label
$menuLabel.Text = 'Welcome! What would you like to do?'
$menuLabel.Location = New-Object System.Drawing.Point(0,10)
$menuLabel.AutoSize = $true

$playbuttton = New-Object System.Windows.Forms.Button
$playbuttton.Text = 'Play'
$playbuttton.Location = New-Object System.Drawing.Size(0,25)
$playbuttton.Size = New-Object System.Drawing.Size(120,23)
$playbuttton.AutoSize = $true

#add the forms and buttons to the main drawing area

$main_form.Controls.Add($menuLabel)
$main_form.Controls.Add($playbuttton)
$main_form.ShowDialog()