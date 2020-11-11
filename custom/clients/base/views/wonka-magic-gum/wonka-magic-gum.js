/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

({
    plugins: ['Dashlet'],

    events: {
        'click [data-action=exesql]': 'exe_sql'
    },

    initDashlet: function () {
        this.sql = 'select * from accounts where deleted=0 limit 3';
        if (App.user.attributes.type == 'admin') {
            this.admin = true;
        }
    },

    exe_sql: function () {
        if (App.user.attributes.type == 'admin') {
            var self = this;
            this.sql = document.getElementById('sql_' + this.cid).value;
            var sql_encoded = encodeURIComponent(this.sql);
            app.api.call('GET', app.api.buildURL('exeSqlQuery') + '?sql=' + sql_encoded, null, {
                success: function (data) {
                    _.extend(self, data);
                    self.render();
                    document.getElementById('CF_' + self.cid).style.overflow = 'scroll';
                },
                error: function (result) {
                    console.log('Error GET exeSqlQuery');
                }
            });
        } else {
            this.error = 'Unauthorized';
        }
    }

})