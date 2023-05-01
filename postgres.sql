-- Tabela "developer"
CREATE TABLE developer (
    id serial not null,
    login varchar(30) not null unique,
    password varchar(255) not null,
    email varchar(255) not null,
    institution varchar(255) not null,
    is_admin boolean not null,
    name varchar(255) not null
);

ALTER TABLE developer 
ADD CONSTRAINT pk_developer
PRIMARY KEY(id);

-- Tabela "respondent"
CREATE TABLE respondent (
    id serial not null,
    login varchar(30) not null unique,
    password varchar(255) not null,
    email varchar(255) not null,
    phone varchar(255) not null,
    name varchar(255) not null
);

ALTER TABLE respondent 
ADD CONSTRAINT pk_respondent
PRIMARY KEY(id);

-- Tabela "quiz"
CREATE TABLE quiz (
    id serial not null,
    name varchar(255) not null,
    description varchar(255) not null,
    date_create timestamp,
    minimum_score int not null,
    developer_id int not null
);

ALTER TABLE quiz 
ADD CONSTRAINT pk_quiz
PRIMARY KEY(id);

ALTER TABLE quiz
ADD CONSTRAINT fk_quiz_developer
FOREIGN KEY(developer_id)
REFERENCES developer(id);

-- Tabela "question"
CREATE TYPE question_type AS ENUM ('essay', 'multiple_choice', 'single_choice');

CREATE TABLE question (
    id serial NOT NULL,
    description varchar(255),
    question_type question_type NOT NULL,
    image text
);

ALTER TABLE question 
ADD CONSTRAINT pk_question
PRIMARY KEY(id);

-- Tabela "quiz_question"
CREATE TABLE quiz_question (
    id serial not null,
    score int not null,
    "order" int not null,
    question_id int not null,
    quiz_id int not null
);

ALTER TABLE quiz_question 
ADD CONSTRAINT pk_quiz_question
PRIMARY KEY(id);

ALTER TABLE quiz_question
ADD CONSTRAINT fk_quiz_question_question
FOREIGN KEY(question_id)
REFERENCES question(id);

ALTER TABLE quiz_question
ADD CONSTRAINT fk_quiz_question_quiz
FOREIGN KEY(quiz_id)
REFERENCES quiz(id);



-- Tabela "alternative"
CREATE TABLE alternative (
    id serial not null,
    description varchar(255) not null,
    is_correct boolean not null,
    question_id int not null
);

ALTER TABLE alternative 
ADD CONSTRAINT pk_alternative
PRIMARY KEY(id);

ALTER TABLE alternative
ADD CONSTRAINT fk_alternative_question
FOREIGN KEY(question_id)
REFERENCES question(id);

-- Tabela "answer"
CREATE TABLE answer (
    id serial not null,
    text text,
    score int not null,
    observation varchar(255),
    question_id int,
    alternative_id int
);

ALTER TABLE answer 
ADD CONSTRAINT pk_answer
PRIMARY KEY(id);

ALTER TABLE answer
ADD CONSTRAINT fk_answer_question
FOREIGN KEY(question_id)
REFERENCES question(id);

ALTER TABLE answer
ADD CONSTRAINT fk_answer_alternative
FOREIGN KEY(alternative_id)
REFERENCES alternative(id);


-- Tabela "offer"
CREATE TABLE offer (
    id serial not null,
    date timestamp,
    quiz_id int not null,
    respondent_id int not null
);

ALTER TABLE offer 
ADD CONSTRAINT pk_offer
PRIMARY KEY(id);

ALTER TABLE offer
ADD CONSTRAINT fk_offer_quiz
FOREIGN KEY(quiz_id)
REFERENCES quiz(id);

ALTER TABLE offer
ADD CONSTRAINT fk_offer_respondent
FOREIGN KEY(respondent_id)
REFERENCES respondent(id);

-- Tabela "submission"
CREATE TABLE submission (
    id serial not null,
    date timestamp not null,
    offer_id int not null
);

ALTER TABLE submission 
ADD CONSTRAINT pk_submission
PRIMARY KEY(id);

ALTER TABLE submission
ADD CONSTRAINT fk_submission_offer
FOREIGN KEY(offer_id)
REFERENCES offer(id);




-- Tabela "offer_answer"
CREATE TABLE offer_answer (
    id serial not null,
    offer_id int not null,
    answer_id int not null
);

ALTER TABLE offer_answer 
ADD CONSTRAINT pk_offer_answer
PRIMARY KEY(id);

ALTER TABLE offer_answer
ADD CONSTRAINT fk_offer_answer_offer
FOREIGN KEY(offer_id)
REFERENCES offer(id);

ALTER TABLE offer_answer
ADD CONSTRAINT fk_offer_answer_answer
FOREIGN KEY(answer_id)
REFERENCES answer(id);
