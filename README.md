# Good to know
> This is only a school assginment that i saving and montioring in this repo.

## The basic look concept
- **Admin interface** / Controll and edit all surface.
- **Search**          / Search games from database 
- **Members**         / List out all members, (last online, number of comments/ratings) 
- **Games**           / List of ALL games in the database (Per instance) Name,Genre,About,Relase Date,Platforms,Develolopers,Gamemodes 
- **Upcoming**        / All upcoming games  											
- **Home**            / Latest relased games(2~4),Latest upcoming games(2~4),Top posts from forum(2~4) 
- **Account**         / Profile pic, Name, Creation Date, Rights, Number of Comments, Number of Ratings | sign in or login
- **forum**           / Categories in category's and topic in category (comments in topics, reply on comment's)  
## Todo list

-[ ] Database is fully controllable from web interface
-[x] Functionable search bar to search games in database
-[x] Members list
-[x] Members list admin interface
-[ ] Members list last online and number of comments and ratings
-[x] List all games from database in a styled web interface
-[x] Game ratings to each game
-[ ] Comment section under eatch game
-[ ] Reply to comments under games
-[ ] Account interface to change profile picture
-[x] List upcoming games under a separate page
-[ ] Home page look
-[ ] Forum look
-[ ] Forum Categories
-[ ] Forum Threads
-[ ] Reply to forum threads and reply to reply
-[ ] Website is fully functional


## DATABASE

  - Users
     - user_id                            / *INT*
     - user_email                         / *VARCHAR*
     - user_name                          / *VARCHAR(20)*
     - user_pwd                           / *VARCHAR(22)*
     - user_rights_id                     / *INT(2)*
     - user_profile_picture_id            / *INT*
     - user_cookiehash                    / *VARCHAR*
     - user_creation_date                 / *DATETIME*
     - user_last_sign_in                  / *DATETIME*
  - Rights      
     - rights_id                          / *INT*
     - rights_name                        / *VARCHAR(20)*
     - rights_level                       / *INT(2)*
  - Games 
     - game_id                            / *INT*
     - game_name                          / *VARCHAR(60)*
     - game_genre                         / *VARCHAR(120)*
     - game_picture                       / *VARCHAR*
     - game_relase_date                   / *DATE*
     - game_platforms                     / *VARCHAR(60)*
     - game_developers                    / *VARCHAR(120)*
     - game_gamemodes                     / *VARCHAR(120)*
     - game_about                         / *TEXT*
     - game_rating                        / *TINYINT(2)*
  - Game_ratings        
     - rating_id                          / *INT*
     - game_id                            / *INT*
     - user_id                            / *INT*
     - rating                             / *TINYINT(2)*
  - Comments      
     - comment_id                         / *INT*
     - comment_text                       / *VARCHAR(500)*
     - comment_is_edited                  / *TINYINT(1)*
     - comment_creation_date              / *DATETIME*
     - comment_last_edit_date             / *DATETIME*
     - comment_is_deleted                 / *TINYINT(1)* <!-- True / False -->
     - comment_game_id                    / *INT* <!-- What games comment section -->
     - comment_parent_id                  / *INT* <!-- reply's -->
  - Old_Comments           
     - old_comment_id                     / *INT*
     - old_comment_original_comment_id    / *INT*
     - old_comment_text                   / *VARCHAR(500)*
     - old_comment_type                   / *VARCHAR* <!-- edited or deleted -->
     - old_comment_changed_by_id          / *INT* <!--  comment creator or admin -->
     - old_comment_change_date            / DATETIME
  - Pictures        
     - picture_id                         / *INT*
     - picture_uploader_id                / *INT*
     - picture_name                       / *VARCHAR*
     - picture_path                       / *VARCHAR*
     - picture_tag                        / *VARCHAR*

  - Categories              
    - category_id                         / *INT*
    - category_name                       / *VARCHAR(50)*
    - category_description                / *VARCHAR(120)*
    - category_parent                     / *INT*
  - Topics              
    - topic_id                            / *INT*
    - topic_subject                       / *VARCHAR(50)*
    - topic_description                   / *VARCHAR(250)*
    - topic_date                          / *DATETIME*
    - topic_category_id                   / *INT*
    - topic_by                            / *INT* <!-- Creator (user) -->
  - Topic_Replies                     
    - reply_id                            / *INT*
    - reply_content                       / *TEXT*
    - reply_date                          / *DATETIME*
    - reply_topic_id                      / *INT*
    - reply_by                            / *INT* <!-- Creator (user) -->
    - reply_parent                        / *INT* <!-- make reply's on comments -->