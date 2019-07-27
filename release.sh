#!/bin/sh
git push
git checkout php
git pull
git merge development
git push
git checkout development
