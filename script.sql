create table account
(
    id         int unsigned auto_increment
        primary key,
    email      varchar(50)                                             not null,
    password   varchar(255)                                            not null,
    name       varchar(255)                                            not null,
    status     enum ('active', 'inactive') default 'inactive'          null,
    token      varchar(255)                                            null,
    created_at datetime                    default current_timestamp() null,
    updated_at datetime                    default current_timestamp() null on update current_timestamp(),
    deleted_at datetime                                                null,
    constraint account_email_uindex
        unique (email)
);


