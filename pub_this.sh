TAG=`cat src/version.txt`
echo $TAG ;
/data/x/tools/masa_pub/rocket_pub.sh  --prj pylon-ng --tag $TAG --host $*;
