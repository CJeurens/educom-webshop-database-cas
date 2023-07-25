SELECT name,straat,huisnr,postcode from `mhl_suppliers` 
WHERE membertype=1 OR membertype=2 OR membertype=3 OR membertype=8;

/*
1 = Gold
2 = Silver
3 = Bronze
8 = GEEN INTERESSE
*/