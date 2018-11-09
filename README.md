# CPSC304
Database management system for a ski resort.

## Set up suggestion:
#### 1. SSH into your CS server and git clone this repository.

``` $ ssh <csId>@remote.ugrad.cs.ubc.ca ```

```$ git clone https://github.com/ceylino/CPSC304```

#### 2. Edit the files locally on your computer in your text editor of choice (if you're looking for suggestions Atom is a great one!)

#### 3. Create a new branch on git for your work and push your local changes on there. Then checkout that branch on the cs server and pull to run.

Create the branch on your local machine and switch in this branch : ```$ git checkout -b [branch_name]```

Change working branch: ```$ git checkout [branch_name]```

Push the branch on github: ```$ git push origin [branch_name]```

You can see all branches created by using: ```$ git branch```

#### 4. When you're done with your feature merge that into the master branch!
(This is a safe way of merging! By pulling master into your branch first you can fix any merge conflict there and then pull in the guaranteed-to-work version to master. This avoids breaking the master branch!) 

```$ git checkout [branch-name]```

``` $ git pull origin master```

```$ git checkout master```

```$ git merge [branch-name]```
