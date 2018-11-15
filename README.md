# CPSC304
Database management system for a ski resort.
## Git Setup:
#### 1. SSH into your CS server and git clone this repository.

``` $ ssh <csId>@remote.ugrad.cs.ubc.ca ```

```$ git clone https://github.com/ceylino/CPSC304```

#### 2. Edit the files locally on your computer in your text editor of choice (if you're looking for suggestions Atom is a great one!)

#### 3. Create a new branch on git for your work and push your local changes on there. Then checkout that branch on the cs server and pull to run.

Create the branch on your local machine and switch in this branch : ```$ git checkout -b [branch_name]```

Change working branch: ```$ git checkout [branch_name]```

Push the branch on github (first time): ```$ git push --set-upstream origin [branch_name]```

Push the branch on github: ```$ git push origin [branch_name]```

You can see all branches created by using: ```$ git branch```

#### 4. When you're done with your feature merge that into the master branch!
(This is a safe way of merging! By pulling master into your branch first you can fix any merge conflict there and then pull in the guaranteed-to-work version to master. This avoids breaking the master branch!) 

```$ git checkout [branch-name]```

``` $ git pull origin master```

```$ git checkout master```

```$ git merge [branch-name]```
## DB Setup:
#### 1. Install XQuartz:
  - Before connecting to the database (with mac) you need to install xQuartz (https://www.xquartz.org/) and follow the installation instructions. 
  - When you're done installing you need to log out of your computer and log back in. (Apple logo in top LHS > log out).
#### 2. SSH:
  - In your terminal ```ssh <csid>@remote.ugrad.cs.ubc.ca``` and don't forget to replace csid! Provide your password etc.
  - then, ```ssh <csid>@thetis.ugrad.cs.ubc.ca```, again don't forget to replace csid! Provide your password etc.
#### 3. Set up your public_html directory:
  - If you haven't previously clones the repo in the server do so now:
    - ```git clone https://github.com/ceylino/CPSC304```
  - ```ls``` to see your home. You should have a public_html folder from Tutorial 8. If not (go back to tutorial 8 and follow the instructions).
  - We need to move the content from the git repo to this public_html directory:
    - in your CPSC304/frontend folder run ```cp *.php ../../public_html/```. This moves all the php files in frontend into the public_html directory.
  - cd into the public_html and run ```chmod 711 *.php```
  - Now you need to repeat the previous steps to more the files in CPSC304/tables into public_html, or else you won't be able to build the tables in the db.
#### 4. Create the tables in the db:
  - cd into the public_html/tables directory (the one you copied from CPSC304 which has all the table creation, deleteion and insertion files)
  - run ```sqlplus```
  - run the following commands ```start dropTables```, ```start createTables``` and ```start insertTables```
  - Now you should have all the tables ready to go!

## Running:
#### 1. Make sure you have the updated versions of the code:
  - run git pull and make sure to copy the updated code into the public_html folder and resetting permissions if need be! see instructions below.
#### 2. Make sure the DB has values:
  - run sqlplus to check. Again if you need to do this see instructions below.
#### 3. Go to the webpage:
  - Paste this into the browser ```http://www.ugrad.cs.ubc.ca/~<csid>/home.php``` and replace csid
