#===================================================
# Program Name : netUtilities
# Author: Michael Vance
#===================================================

#Resolve a hostname to the ip address(s)
#Ping address(s) to see if they are online
#Name: Test-IPHost

function Test-IPHost {
    param([parameter(
        Mandatory=$true)]
        $IPname,
        $count)
    if($count){}else {
        $count = 4
    }


    try{
    $checkName = Resolve-DnsName $IPname -ErrorAction Stop|Where-Object {$_.section -eq 'Answer' -and $_.type -eq 'a'}}
    catch{Write-Host 'Name is invalid. Check spelling and try again.'}
        foreach($check in $checkName){
            ping ($check.IPAddress) -n $count
        } 
}








#Get-IPNetwork: Using an ip determine the network it is on. 
Function Get-IPNetwork {
    param([parameter(Mandatory=$true)]
        $TestIP
        ,
        $SubMask)

        #check to see if they are using CIDR
        $cidr = $TestIP -split '/'
        if($cidr[1]){
            #First validate the ip.
            try{
                $ip = [ipaddress]$cidr[0]}
                catch{Write-Host 'Invalid IP.'
                return}

            
            try{
                if([int]$cidr[1] -lt 0 -or [int]$cidr[1] -gt 32){Write-Host 'CIDR notation must be between 0 and 32'
                    return}}
                catch{Write-Host 'Invalid CIDR.'
                return}

            #possible values for the subnet are stored in a hashtable
            $PossibleMasks=@{
                0=[net.ipaddress]'0.0.0.0';
                1=[net.ipaddress]'128.0.0.0';
                2=[net.ipaddress]'192.0.0.0';
                3=[net.ipaddress]'224.0.0.0';
                4=[net.ipaddress]'240.0.0.0';
                5=[net.ipaddress]'248.0.0.0';
                6=[net.ipaddress]'252.0.0.0';
                7=[net.ipaddress]'254.0.0.0';
                8=[net.ipaddress]'255.0.0.0';
                9=[net.ipaddress]'255.128.0.0';
                10=[net.ipaddress]'255.192.0.0';
                11=[net.ipaddress]'255.224.0.0';
                12=[net.ipaddress]'255.240.0.0';
                13=[net.ipaddress]'255.248.0.0';
                14=[net.ipaddress]'255.252.0.0';
                15=[net.ipaddress]'255.254.0.0';
                16=[net.ipaddress]'255.255.0.0';
                17=[net.ipaddress]'255.255.128.0';
                18=[net.ipaddress]'255.255.192.0';
                19=[net.ipaddress]'255.255.224.0';
                20=[net.ipaddress]'255.255.240.0';
                21=[net.ipaddress]'255.255.248.0';
                22=[net.ipaddress]'255.255.252.0';
                23=[net.ipaddress]'255.255.254.0';
                24=[net.ipaddress]'255.255.255.0';
                25=[net.ipaddress]'255.255.255.128';
                26=[net.ipaddress]'255.255.255.192';
                27=[net.ipaddress]'255.255.255.224';
                28=[net.ipaddress]'255.255.255.240';
                29=[net.ipaddress]'255.255.255.248';
                30=[net.ipaddress]'255.255.255.252';
                31=[net.ipaddress]'255.255.255.254';
                32=[net.ipaddress]'255.255.255.255';
            }#End of hashtable.

            #Store the ip, then get the mask.
            $ip = [IPAddress]$cidr[0]
            $mask = $PossibleMasks.[int]$cidr[1]
            #Binary and the address and mask, then return the network id
            $net=[IPAddress]($ip.Address -band $mask.Address)
                Write-Output $net
                return
        }



        #If they aren't using CIDR, check it normally
        try{
        $ip = [ipaddress]$TestIP}
        catch{Write-Host 'Invalid IP.'
                return}

        if($SubMask){$mask=[ipaddress]$SubMask
        $net=[IPAddress]($ip.Address -band $mask.Address)
        Write-Output $net
        return
            }
        else{
            $findClass = $ip.IPAddressToString -split '.',2,'SimpleMatch'
            if($findClass[0] -le 127){$mask = [ipaddress]'255.0.0.0'}
            if($findClass[0] -gt 127 -and $findClass -le 191){$mask = [ipaddress]'255.255.0.0'}
            if($findClass[0] -ge 192 -and $findClass -le 223){$mask = [ipaddress]'255.255.255.0'}
            if($findClass[0] -ge 224){Write-Output 'Class D and E are more experimental'; exit}
            $net=[IPAddress]($ip.Address -band $mask.Address)
            Write-Output $net
        }
}







#Test-IPNetwork: Determine if two addresses are on the same network. Return $true if they are
#and $false if they are not. Allow the subnet to be entered in CIDR or dotted decimal.
Function Test-IPNetwork{
        param([parameter(Mandatory=$true)]$ip1,[parameter(Mandatory=$true)]$ip2)
        $netTest1 = Get-IPNetwork $ip1
        $netTest2 = Get-IPNetwork $ip2
        return ($netTest1 -eq $netTest2)
}



#My function: Renew-IP. Releases an old ip, gets a new one and optionally flushes the dns cache
#This is a work in progress. Need to make it Windows-independant and/or more useful
<#Function Renew-IP{
    param($flush)
    if($flush){if($flush -eq 'Y' -or $flush -eq 'Yes'){ipconfig /flushdns}}
    ipconfig /release
    ipconfig /renew
    write-host  'Renew complete' -ForeGroundColor Green
}#>