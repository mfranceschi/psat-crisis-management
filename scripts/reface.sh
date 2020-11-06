rm index.php;
for filename in *.hacked; do
	mv $filename "${filename%%.*}".php
done

