/**
 * Declare some vars so we can reference easier
 * Note that __ is a function variable too
  */
var addRuleTypeCategory = BBLogic.api.addRuleTypeCategory,
    addRuleType = BBLogic.api.addRuleType,
    getFormPreset = BBLogic.api.getFormPreset,
    __ = BBLogic.i18n.__;

/**
 * Add a RuleType Category to file it under
 */
addRuleTypeCategory(
	/* Identifier for the category */
	'acme_filter', {
	/* Label for this category/group */
    label: __('ACME Filter')
});

/**
 * PLEASE NOTE:
 * the order in which the items appear in the menu
 * is determined by the order they are declared in.
 */


/** DEMO Rule which uses rest route */
addRuleType('acme_filter/acme_field-demo', {

	/* label */
    label: __('ACME DEMO Filter'),

    /*  category */
    category: 'acme_filter',

    /* form */
	form: function form(_ref) {

		var rule = _ref.rule;

		/*  var references to _ref.rule.fieldtype */
		var siteaction = rule.siteaction;

		return {
			siteaction: {
				type: 'select',
				route: 'bb-logic/v1/acmefilter/actions',	/* rest call: //www.yourdomainname.com/wp-json/bb-logic/v1/acmefilter/actions */

			},
			operator: {
				type: 'operator',
				operators: [ 'contains' , 'does_not_contain' ,'equals', 'does_not_equal' ],
				visible: siteaction, // only visible when siteactions has been selected
			},
            compare: {
                type: 'text',
                placeholder: __('Value'),
				visible: siteaction, // only visible when siteactions has been selected
            },

		};
	}
});


addRuleType('acme_filter/archive-field', {
	label: __('ACME Archive Field'),
	category: 'acme_filter',
	form: getFormPreset('key-value')
});

addRuleType('acme_filter/post-field', {
	label: __('ACME Post Field'),
	category: 'acme_filter',
	form: getFormPreset('key-value')
});

addRuleType('acme_filter/post-author-field', {
	label: __('ACME Post Author Field'),
	category: 'acme_filter',
	form: getFormPreset('key-value')
});

addRuleType('acme_filter/user-field', {
	label: __('ACME User Field'),
	category: 'acme_filter',
	form: getFormPreset('key-value')
});

addRuleType('acme_filter/option-field', {
	label: __('ACME Option Field'),
	category: 'acme_filter',
	form: getFormPreset('key-value')
});


