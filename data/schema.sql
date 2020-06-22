CREATE DATABASE IF NOT EXISTS inno;

CREATE TABLE IF NOT EXISTS contest_winners(
    contest_id varchar(155) NOT NULL,
    contestant_id varchar(155) NOT NULL,
    score integer NOT NULL,
    created_at timestamp default current_timestamp
);
