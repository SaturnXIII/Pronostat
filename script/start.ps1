cd path\PronostatV0.3\script

rm path\PronostatV0.3\friendlist\exemple.txt
Start-Sleep -Seconds 15 
python3 user1.py
echo Scraping of user1 OK 
Start-Sleep -Seconds 15 
python3 user2.py
echo Scraping of user2 OK 
