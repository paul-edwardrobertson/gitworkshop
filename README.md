### gitworkshop
Workshop for learning GIT

## Basic Instructions for Github

# 1. The Basics

A basic git operation has three stages.

    1. git add
        At this stage you select which files you would like to upload.

    2. git commit
        At this stage, you confirm the files you have selected and add a message to say what the purpose of the commit is

    3. git push
        This is where the selected files are uploaded to the website.
        
    4. git push -u origin master
        This will push files to the origin master

    5. git --version
        Show installed git version.
        
    6. git init
        Initialise empty git repsitory inside your project.
        
    7. git config --global user.name 'your_username'
        Set username in your git config.
        
    8. git config --global user.email 'your_email'
        Set email in your git config
        
    9. git add index.html OR git add .
        Stage individual or all files for commit.
        
    10. git status
        Show what's in staging area.
        
    11. git rm --cached index.html
        Remove index.html from the staging area.
        
    12. git commit -m 'your_comment'
        Add a comment and commit staged files.
        
# 2. Branches

    1. git branch branch_name
        Create a new branch
        
    2. git checkout 'branch_name'
        Switch to 'branch_name'.
        
    3. git checkout master
        Switch to master branch.
        
    4. git merge branch_name
        Merge branch_name with master branch. Note: run this command from master branch.
        
# 3. Remote Repositories

On GitHub, create a remote repository using their interface, then open terminal in your code editor and do the following:

    1. git remote add origin link_to_your_repository
        Set this to be remote repository for your project.
        
    2. git push -u origin master
        Push all files to the created repository on GitHub. You might be required to enter your username/email and password.
        
    3. git clone link_to_remote_repository
        Clone repository (download on your machine in designated location). Note: make sure to change directory to where you want to clone the project
        
# 4. .gitignore

You can create .gitignore file to to tell git which files should not be commited. This file MUST be in the root directory of your project.

    1. touch .gitignore
        Create .gitignore file
        
Insdie you can specify which files should not be commited, for example:

    1. log.txt
        Ignore specific file.
        
    2. /dir
        Ignore specific directory.
        
    3. *.txt
        Ignore all files with .txt extension.
        
    4. .DS_STORE
        Ignore annoying files.
    
# 5. Best Practices

    1. Commit related files together & commit each "job" seperately (easier to rollback when problem occurs).
    2. Commit messages: one sentence, present tense, short.
    3. Always pull work before starting a work to avoid conflicts.

    
