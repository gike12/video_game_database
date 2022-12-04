# Good to know
> This is only a school assginment that i saving and montioring in this repo.

## The basic look concept
- Admin interface / Controll and edit all surface.
- Search          / Search games from database 
- Members         / List out all members, (last online, number of comments/ratings) 
- Games           / List of ALL games in the database (Per instance) Name,Genre,About,Relase Date,Platforms,Develolopers,Gamemodes 
- Upcoming        / All upcoming games  											
- Home            / Latest relased games(2~4),Latest upcoming games(2~4),Top posts from forum(2~4) 
- Account         / Profile pic, Name, Creation Date, Rights, Number of Comments, Number of Ratings | sign in or login
- forum           / Categories in category's and topic in category (comments in topics, reply on comment's)  



## DATABASE

  - Users
     - user_id / INT
     - user_email / VARCHAR
     - user_name / VARCHAR(20)
     - user_pwd / VARCHAR(22)
     - user_rights_id / INT(2)
     - user_profile_picture_id / INT
     - user_cookiehash / VARCHAR
     - user_creation_date / DATETIME
     - user_last_sign_in / DATETIME
  - Rights      
     - rights_id / INT
     - rights_name / VARCHAR(20)
     - rights_level / INT(2)
  - Games 
     - game_id / INT
     - game_name / VARCHAR(60)
     - game_genre / VARCHAR(120)
     - game_picture / VARCHAR
     - game_relase_date / DATE
     - game_platforms / VARCHAR(60)
     - game_developers / VARCHAR(120)
     - game_gamemodes / VARCHAR(120)
     - game_about / TEXT
     - game_rating / TINYINT(2)
  - Game_ratings        
     - rating_id / INT
     - game_id / INT
     - user_id / INT
     - rating / TINYINT(2)
  - Comments      
     - comment_id / INT
     - comment_text / VARCHAR(500)
     - comment_is_edited / TINYINT(1)
     - comment_creation_date / DATETIME
     - comment_last_edit_date / DATETIME
     - comment_is_deleted (True / False) / TINYINT(1)
     - comment_game_id   (What games comment section) / INT
     - comment_parent_id (reply's) / INT
  - Old_Comments           
     - old_comment_id / INT
     - old_comment_original_comment_id / INT
     - old_comment_text / VARCHAR(500)
     - old_comment_type (edited or deleted) / VARCHAR
     - old_comment_changed_by_id (comment creator or admin) / INT
     - old_comment_change_date / DATETIME
  - Pictures
     - picture_id / INT
     - picture_uploader_id / INT
     - picture_name / VARCHAR
     - picture_path / VARCHAR
     - picture_tag / VARCHAR
 
  - Categories
    - category_id / INT
    - category_name / VARCHAR(50)
    - category_description / VARCHAR(120)
    - category_parent / INT
  - Topics
    - topic_id / INT
    - topic_subject / VARCHAR(50)
    - topic_description / VARCHAR(250)
    - topic_date / DATETIME
    - topic_category_id / INT
    - topic_by ( Creator (user)) / INT
  - Topic_Replies
    - reply_id / INT
    - reply_content / TEXT
    - reply_date / DATETIME
    - reply_topic_id / INT
    - reply_by ( Creator (user)) / INT
    - reply_parent ( make reply's on comments ) / INT