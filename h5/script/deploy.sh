read -p "输入commit信息:" word
if  [ ! -n "$word" ] ;then
    echo "您没有输入commit信息!"
    exit 0
else
    GIT_PATH=/E/private/ipinche/car
    FILE_PATH=/E/private/ipinche/car/web/static/h5
    CUR_PATH=/E/private/ipinche/car/h5
    cd $GIT_PATH
    git config --global core.autocrlf false
    git pull origin master
    rm -rf $FILE_PATH/*
    cd $CUR_PATH
    cp -r dist/* $FILE_PATH
    cd $GIT_PATH
    git add web/static/h5/*
    git commit -a -m "$word"
    git push origin master
    exit 0
fi
