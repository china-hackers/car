read -p "输入commit信息:" word
if  [ ! -n "$word" ] ;then
    echo "您没有输入commit信息!"
    exit 0
else
    GIT_PATH=/Users/mac/work/car
    FILE_PATH=/Users/mac/work/car/web/static/admin
    CUR_PATH=/Users/mac/work/car/admin
    cd $GIT_PATH
    git config --global core.autocrlf false
    git pull origin master
    rm -rf $FILE_PATH/*
    cd $CUR_PATH
    cp -r dist/* $FILE_PATH
    cd $GIT_PATH
    git add web/static/admin/*
    git commit -a -m "$word"
    git push origin master
    exit
fi
