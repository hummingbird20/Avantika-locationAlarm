# -*- coding: utf-8 -*-
# Generated by Django 1.11.15 on 2018-09-20 13:47
from __future__ import unicode_literals

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('articles', '0002_auto_20180920_1202'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='usersettings',
            name='username',
        ),
        migrations.AddField(
            model_name='savedlocations',
            name='username',
            field=models.ForeignKey(null=True, on_delete=django.db.models.deletion.CASCADE, to='articles.UserInformation'),
        ),
        migrations.AddField(
            model_name='usercontacts',
            name='username',
            field=models.ForeignKey(null=True, on_delete=django.db.models.deletion.CASCADE, to='articles.UserInformation'),
        ),
        migrations.AlterField(
            model_name='savedlocations',
            name='destination',
            field=models.CharField(max_length=50, null=True),
        ),
        migrations.AlterField(
            model_name='savedlocations',
            name='source',
            field=models.CharField(max_length=50, null=True),
        ),
        migrations.AlterField(
            model_name='usercontacts',
            name='number',
            field=models.IntegerField(max_length=12, null=True),
        ),
        migrations.AlterUniqueTogether(
            name='savedlocations',
            unique_together=set([('username', 'source', 'destination')]),
        ),
        migrations.AlterUniqueTogether(
            name='usercontacts',
            unique_together=set([('username', 'number')]),
        ),
        migrations.DeleteModel(
            name='UserSettings',
        ),
    ]