-- Tabela "developer"
-- senha Joao 12345
-- senha maria 54321
-- senha pedro abcde
INSERT INTO developer (login, password, email, institution, is_admin, name) VALUES ('joao', '827ccb0eea8a706c4c34a16891f84e7b', 'joao@email.com', 'UFMG', true, 'João');
INSERT INTO developer (login, password, email, institution, is_admin, name) VALUES ('maria', '01cfcd4f6b8770febfb40cb906715822', 'maria@email.com', 'USP', false, 'Maria');
INSERT INTO developer (login, password, email, institution, is_admin, name) VALUES ('pedro', 'ab56b4d92b40713acc5af89985d4b786', 'pedro@email.com', 'Unicamp', false, 'Pedro');

-- Tabela "respondent"
-- senha Joao 11111
-- senha maria 22222
-- senha pedro 33333
INSERT INTO respondent (login, password, email, phone, name) VALUES ('ana', 'b0baee9d279d34fa1dfd71aadb908c3f', 'ana@email.com', '99999999', 'Ana');
INSERT INTO respondent (login, password, email, phone, name) VALUES ('lucas', '3d2172418ce305c7d16d4b05597c6a59', 'lucas@email.com', '88888888', 'Lucas');
INSERT INTO respondent (login, password, email, phone, name) VALUES ('carla', 'b7bc2a2f5bb6d521e64c8974c143e9a0', 'carla@email.com', '77777777', 'Carla');

-- Tabela "quiz"
INSERT INTO quiz (name, description, date_create, minimum_score, developer_id) VALUES ('Quiz 1', 'This is the first quiz', NOW(), 5, 1);
INSERT INTO quiz (name, description, date_create, minimum_score, developer_id) VALUES ('Quiz 2', 'This is the second quiz', NOW(), 7, 2);
INSERT INTO quiz (name, description, date_create, minimum_score, developer_id) VALUES ('Quiz 3', 'This is the third quiz', NOW(), 6, 3);

-- Tabela "question"
INSERT INTO question (description, question_type, image) VALUES ('What is the capital of Brazil?', 'single_choice', NULL);
INSERT INTO question (description, question_type, image) VALUES ('What is the biggest planet in our solar system?', 'multiple_choice', NULL);
INSERT INTO question (description, question_type, image) VALUES ('Explain the difference between HTML and CSS.', 'essay', NULL);

-- Tabela "quiz_question"
INSERT INTO quiz_question (score, "order", question_id, quiz_id) VALUES (2, 1, 1, 1);
INSERT INTO quiz_question (score, "order", question_id, quiz_id) VALUES (3, 2, 2, 1);
INSERT INTO quiz_question (score, "order", question_id, quiz_id) VALUES (5, 3, 3, 1);

-- Tabela "alternative"
INSERT INTO alternative (description, is_correct, question_id) VALUES ('São Paulo', false, 1);
INSERT INTO alternative (description, is_correct, question_id) VALUES ('Rio de Janeiro', true, 1);
INSERT INTO alternative (description, is_correct, question_id) VALUES ('Brasília', false, 1);

-- Tabela "answer"
INSERT INTO answer (text, score, observation, question_id, alternative_id)
VALUES ('Resposta 1', 10, 'Observação 1', 1, NULL);

INSERT INTO answer (text, score, observation, question_id, alternative_id)
VALUES ('Resposta 2', 20, 'Observação 2', 2, NULL);

INSERT INTO answer (text, score, observation, question_id, alternative_id)
VALUES ('Alternativa 1 da pergunta 3', 5, NULL, 3, 1);

INSERT INTO answer (text, score, observation, question_id, alternative_id)
VALUES ('Alternativa 2 da pergunta 3', 10, NULL, 3, 2);

-- Tabela "offer"
INSERT INTO offer (date, quiz_id, respondent_id)
VALUES ('2023-05-01 10:30:00', 1, 1);

INSERT INTO offer (date, quiz_id, respondent_id)
VALUES ('2023-05-01 14:00:00', 2, 2);

INSERT INTO offer (date, quiz_id, respondent_id)
VALUES ('2023-05-02 09:00:00', 3, 3);

-- Tabela "submission"
INSERT INTO submission (date, offer_id)
VALUES ('2023-05-01 11:00:00', 1);

INSERT INTO submission (date, offer_id)
VALUES ('2023-05-01 15:00:00', 2);

INSERT INTO submission (date, offer_id)
VALUES ('2023-05-02 10:00:00', 3);

-- Tabela "offer_answer"
INSERT INTO offer_answer (offer_id, answer_id)
VALUES (1, 1);

INSERT INTO offer_answer (offer_id, answer_id)
VALUES (2, 2);