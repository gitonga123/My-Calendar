TABLE USERS
	user_id
	first_name
	last_name
	other_names
	gender
	DOB
	county
	occupation
	profile_photo
	membership_approved
	date_of_approval
	id_number
	account_creation_date
	membership_fee
	account_approved_by
	user_unique_key

TABLE INVESTMENTS
	investment_id 
	commencement_date
	amount_invested
	amount_expected //projections
	investment_period
	description
	type_investment //property, farming
	investment_authorized_by
	members_invloved

Table ACTIVE LOANS
	loan_id
	loan_period
	interest
	expected_interest
	loaned_to
	amount_loaned
	amount_paid
	expected_date_of_completion 
	loan_approved_by
	guarantor
	minimum_monthly_contribution
	active_loan

Table FUllY PAID LOANS
	loan_id
	loan_period
	interest_charged
	loaned_to
	amount_loaned
	amount_paid_monthly
	loan_completion_date
	loan_was_approved_by
	guarantor
	minimum_paid
	terms_of_payement

Table Shares
	share_id 


Table CONFIGURATIONS
	id
	field_name

TABLE EXPENDITURES
	expe_id
	amount
	exe_description
	authorized_by
	date_of_payment

Table EVENTS
	event_id
	date_of_event
	invation_to
	mode_of_communication //mass mailing/messaging
	place
	time_to_start
	time_to_end
	event_title
	event_description
	event_approved_by

TABLE notifications
	notification_id
	message
	date_to_send

TABLE members_contribution
	member_id 
	last_contribution
	total_amount_contributed
	share_id
	


