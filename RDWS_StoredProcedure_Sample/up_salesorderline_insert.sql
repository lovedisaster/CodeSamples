--------------------------------- 
-- up_salesorderline_insert.sql  
---------------------------------

---------------------------------------------------------------------------------------
-- Maintenance Log
---------------------------------------------------------------------------------------
-- Task   | Who | Date     | Comments
----------+-----+----------+------------ RDWS 1.6.2.1 ---------------------------------
-- 019110 | DCZ | 20120427 | Added a new optional input, delivery instruction, to be 
--                         | recorded against a sales order in the new salesorderdelivery
--						   | table.
----------+-----+----------+------------ RDWS 1.6.1.1 ---------------------------------
-- 019063 | YFZ | 20120316 | Add originating_store_code to salesorder,customer_discount_voucher,   
--                         | deliver_after_date of to salesorderline table.
----------+-----+----------+------------ RDWS 1.5.8.1 ---------------------------------
-- 018752 | DCZ | 20120106 | (MG 018416) Updated stored procedure to override enforcement
--                         | of unique external order code if needed.
----------+-----+----------+------------ RDWS 1.5.7.1 ---------------------------------
-- 018514 | YFZ | 20111116 | Updated to ensure that old ID generation code is removed
--                         | this was causing the proc to attempt to insert with a NULL
--                         | value for salesorder_code.
----------+-----+----------+------------ RDWS 1.5.7.1 ---------------------------------
-- 018490 | YFZ | 20111116 | Updated to remove ID and code generation from main stored 
--						   | procedure. This is now done using the
--                         | up_salesorder_create_base_id_and_code stored procedure.
----------+-----+----------+-----------------------------------------------------------
-- 014934 | MEH | 20090210 | Added freight_amount (output). This value is calculated based
--                         | on the fixeditemcoloursize with a fixeditem_type of "FR". If
--                         | no value is specified for this, the freight_amount will be
--                         | set to 0. The value calculated will be recorded in the
--                         | salesorder.freight_amount field.
-- 014394 | MEH | 20091223 | Updated to allow the status of a sales order to be specified
--                         | in the input. An initial status of "Approved" (approved_ind
--                         | = 'Y') or "Pending" (approved_ind = 'N') is allowed. If the
--                         | approved_ind is set to 'N', it must be updated to 'Y' to
--                         | allow automated processing of the sales order to take place.
--                         | This may be accomplished through the SalesOrderFinalise
--                         | web service.
-- 015670 |	DCZ | 20100624 | Added input field shipregionmethod_id to record freight
--                         | method against the sale order.
-- 016030 | MEH	| 20100802 | * Added default value and validity check for shipregionmethod_id.
--                         | * Re-instated calculation of @freight_amount based on fixed ics
--                         |   (Only if no @shipregionmethod_id is supplied). This allows for
--                         |   backwards compatibility of this stored proc with older versions
--                         |   of RDWS if required.
--                         | * Added optional parameter: external_order_code to allow the
--                         |   order code (iSAMSOrderID in the case of Rodd and Gunn web sales)
--                         |   to be recorded against the salesorder.
--                         |   When a new sales order is inserted, if this parameter is not null
--                         |   the salesorder table will be checked for the existence of a 
--                         |   salesorder with the same external_order_code. If one exists, the
--                         |   sales order will be deemed to be a duplicate order and will not
--                         |   be processed. This check will only occur when creating a new
--                         |   sales order (i.e. the salesorder_code is null).
--                         | * Added optional parameter: @override_tax_pct_ind which allows the @tax_pct
--                         |   parameter to be used as an input parameter which overrides the normal tax
--                         |   rate of the item. This is used when an order is placed for delivery to a
--                         |   different country than were the goods are sold from. In this case the @tax_pct
--                         |   will be set to 0.00.
--                         | * Added NOLOCK hint to various select queries.
-- 015670 | DCZ | 20100813 | shipregionmethod implementation has been rolled back as
--		  |		|		   | the task has been put on hold.
-- 017686 | DCZ | 20110606 | If using new freight feature, use the freigt item to sum up
--		  |		|		   | freight total.
-- 017689 |	DCZ | 20110620 | Enhanced to use salesorderline calculate if customer type 
--		  |		|		   | was specified.
-- 018050 | DCZ | 20110801 | (MG) Added a statement prevent nextnum id issues.
----------+-----+----------+-----------------------------------------------------------

EXEC sp_addmessage @msgnum = 57801, @severity = 16, 
   @msgtext = N'Unable to create order. The deliveryDueDateTime is before the salesDate. Enter an deliveryDueDateTime that is not before the salesDate.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57802, @severity = 16, 
   @msgtext = N'Unable to create order. The supplychannelCode %s is not correct. Enter a correct supplychannelCode.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57803, @severity = 16, 
   @msgtext = N'Unable to create order. The storeCode %s is not correct. Enter a correct storeCode.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57804, @severity = 16, 
   @msgtext = N'Unable to create order. The customerId %s is not correct. Enter a correct customerId.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57805, @severity = 16, 
   @msgtext = N'Unable to create order. The locationRef %s is incorrect. Enter a correct locationRef.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57806, @severity = 16, 
   @msgtext = N'Unable to create order. The sellcodeCode %s is incorrect or inactive. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57807, @severity = 16, 
   @msgtext = N'Unable to create order. The locationRef %s is set to inactive. Enter an active locationRef.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57808, @severity = 16, 
   @msgtext = N'Unable to create order. The barcodeCode %s is incorrect or inactive. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57809, @severity = 16, 
   @msgtext = N'Unable to create order. The itemcolourRef %s is incorrect or inactive. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57810, @severity = 16, 
   @msgtext = N'Unable to create order. The sizeCode %s is incorrect or inactive. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57811, @severity = 16, 
   @msgtext = N'Unable to create order. The prepackRef %s is incorrect or inactive. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57812, @severity = 16, 
   @msgtext = N'Unable to create order. No item reference was entered. Enter a correct item reference.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57813, @severity = 16, 
   @msgtext = N'Unable to create order. No sizeCode or prepackRef was entered. Enter a correct sizeCode or prepackRef.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57814, @severity = 16, 
   @msgtext = N'Unable to create order. The orderQuantity is zero or less. Enter an orderQuantity that is greater than zero.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57815, @severity = 16, 
   @msgtext = N'Unable to create order. The unitPrice is less than zero. Enter a unitPrice that is not negative.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57816, @severity = 16, 
   @msgtext = N'Unable to identify item. The %s were both specified. Enter either %s.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57817, @severity = 16, 
   @msgtext = N'Unable to identify item. The %s are not the same item. Enter matching %s, or either %s.',
	@replace = 'replace'

--EXEC sp_addmessage @msgnum = 57829, @severity = 16, 
--   @msgtext = N'Unable to create order. The shipregionmethod_id (%s) does not identify a valid and active shipregionmethod.',
--	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57830, @severity = 16, 
   @msgtext = N'Unable to create order. A sales order with the external_order_code (%s) already exists in the system. This order appears to be a duplicate of the existing sales order (%s).',
	@replace = 'replace'
	
EXEC sp_addmessage @msgnum = 57831, @severity = 16, 
   @msgtext = N'Unable to create order. A sales order line with the salesorderline_id (%s) already exists.',
	@replace = 'replace'
	
EXEC sp_addmessage @msgnum = 57832, @severity = 16, 
   @msgtext = N'Unable to create order. A salesorder code must be specified.',
	@replace = 'replace'

EXEC sp_addmessage @msgnum = 57835, @severity = 16, 
   @msgtext = N'Unable to create order. The originating store code %s is not correct. Enter a correct originating store code.',
	@replace = 'replace'
	
EXEC sp_addmessage @msgnum = 57836, @severity = 16, 
   @msgtext = N'Unable to create order. A salesorderdelivery code must be specified.',
	@replace = 'replace'	

GO

IF OBJECT_ID('up_salesorderline_insert') IS NOT NULL
BEGIN
	DROP PROCEDURE dbo.up_salesorderline_insert
END
GO

CREATE PROCEDURE dbo.up_salesorderline_insert
	@salesorder_code        VARCHAR(12)   output,
	@customer_id            VARCHAR(12),
	@store_code	            VARCHAR(12),
	@supplychannel_code     VARCHAR(12),
	@status			        VARCHAR(12)   output,
	@user_code		        VARCHAR(12),
	@sales_date		        DATETIME      output,
	@delivery_due_date_time DATETIME      output,
	@multiple_delivery_ind  CHAR(1)       output,
    @freight_amount         NUMERIC(19,4) output,
	@sellcode_code          VARCHAR(16)   output,
	@barcode_code           VARCHAR(16)   output,
	@itemcolour_ref         VARCHAR(32)   output,
	@size_code              VARCHAR(12)   output,
	@prepack_ref            VARCHAR(32)   output,
	@order_quantity         NUMERIC(20,4),
	@sell_price_per_unit    NUMERIC(20,4) output,
	@tax_pct                NUMERIC(19,4) output,
	@tax_amount             NUMERIC(20,4) output,
	@location_ref           VARCHAR(12),
--	@shipregionmethod_id	VARCHAR(12) = NULL,
    @external_order_code    VARCHAR(32) = NULL,
    @override_tax_pct_ind   CHAR(1) = 'N',
    @salesorderline_id    VARCHAR(12) = NULL,
    @create_new_salesorder CHAR(1) = 'N',
    @list_price_per_unit    NUMERIC(20,4) = 0 output,
    @eff_price_overflow		NUMERIC(10,2)= 0  output,
    @customertype_code		VARCHAR(12) = NULL,			-- Optional Input
    @discount_description	VARCHAR(50) = NULL output,	-- Optional Output
    @originating_store_code   VARCHAR(12) = NULL,
    @customer_discount_voucher VARCHAR(50) = NULL,
    @deliver_after_date       DATETIME,
    @salesorderdelivery_code	VARCHAR(16) = NULL,			-- Optional Input
    @delivery_instructions	VARCHAR(255) = NULL			-- Optional Input 
AS
-------------------------------------------------------------------------
-- RDWS Version RDWSVersionNumber
-------------------------------------------------------------------------

DECLARE
	@itemcoloursize_id  VARCHAR(12),
	@customersite_id    VARCHAR(12),
	@datacentre_code    VARCHAR(4),
	@nextnum_id         VARCHAR(12),
	@currency_code      VARCHAR(12),
	@return             INT,
	@pricemethod_code   VARCHAR(12),
	@scalerating_id     VARCHAR(12),
    @approved_ind       CHAR(1),
    @lead_time_days     NUMERIC(20,4),
    @freight_fixeditem_type VARCHAR(2),
    @freight_ics_id     VARCHAR(12),
    @duplicate_salesorder_code VARCHAR(12),
    @discountcustomer_code	VARCHAR(12),
    @RDWS_NONUNIQUE_EXT_ORDER_CODE CHAR(1)

	-- As of 1.5.1.1 the status is set in the Web service business logic layer.
    -- this status can be either 'Approved' or 'Pending'
	-- The status of a new order will always be 'Approved'
	--SET @status = 'Approved'
    
    -- fixeditem_type for freight charge.
    SET @freight_fixeditem_type = 'FR'
    
    -- Throw an error if no salesorder code is supplied.
    IF ISNULL(@salesorder_code,'') = ''
    BEGIN
		RAISERROR(57832, 16, 4)
    END

	SELECT @datacentre_code = datacentre_code 
	  FROM datacentre WITH(NOLOCK)
	 WHERE headoffice_ind = 'Y'
	
	IF IsNull(@datacentre_code, '') = ''
	BEGIN
		RAISERROR (56150, 16, 4)
		RETURN -1
	END

	IF NOT EXISTS (SELECT 1
			FROM customer WITH(NOLOCK)
			WHERE customer_id = @customer_id
			AND customer_status_ind = 'A')
	BEGIN
		RAISERROR (57804, 16, 4, @customer_id)
		RETURN -1
	END	

	IF ISNULL(@sellcode_code, '') <> ''
	BEGIN
	    IF NOT EXISTS (SELECT 1
			   FROM   sellcode WITH(NOLOCK), itemcoloursize WITH(NOLOCK), itemcolour WITH(NOLOCK)
			   WHERE  sellcode.sellcode_code = @sellcode_code
			    AND   sellcode.active_ind = 'Y'
			    AND   sellcode.itemcoloursize_id = itemcoloursize.itemcoloursize_id
			    AND   itemcoloursize.active_ind = 'Y'
			    AND   itemcoloursize.itemcolour_id = itemcolour.itemcolour_id
			    AND   itemcolour.active_ind = 'Y')
	    BEGIN
		RAISERROR (57806, 16, 4, @sellcode_code)
		RETURN -1
	    END
	    ELSE
	    BEGIN
		  -- check to make sure that there isn't a barcode_code or itemcolour_ref 
		  -- and prepack_ref also specified.
		IF ISNULL(@barcode_code, '') <> ''
		BEGIN
		    RAISERROR (57816, 16, 4, 'sellcodeCode and barcodeCode', 'sellcodeCode or barcodeCode')
		    RETURN -1
		END
		IF (ISNULL(@itemcolour_ref, '') <> ''
		AND ISNULL(@prepack_ref, '') <> '')
		BEGIN
		    RAISERROR (57816, 16, 4, 'sellcodeCode and itemcolourRef and prepackRef', 'sellcodeCode or itemcolourRef and prepackRef')
		    RETURN -1
		END
		  -- If the sellcode_code and an itemcolour_ref and size_code are specified
		  -- make sure they match.
		IF  ISNULL(@itemcolour_ref, '') <> '' 
		AND ISNULL(@size_code, '') <> ''
		AND NOT EXISTS (SELECT 1
				FROM   sellcode WITH(NOLOCK), itemcolour WITH(NOLOCK), itemcoloursize WITH(NOLOCK)
				WHERE  sellcode.sellcode_code = @sellcode_code
		 		AND   sellcode.active_ind = 'Y'
		 		AND   sellcode.itemcoloursize_id = itemcoloursize.itemcoloursize_id
		 		AND   itemcoloursize.active_ind = 'Y'
		 		AND   itemcoloursize.itemcolour_id = itemcolour.itemcolour_id
		 		AND   itemcolour.active_ind = 'Y'
				AND   itemcolour.itemcolour_ref = @itemcolour_ref
			 	AND   itemcoloursize.size = @size_code)
		BEGIN
		    RAISERROR (57817, 16, 4, 'sellcodeCode and itemcolourRef and sizeCode', 'sellcodeCode and itemcolourRef and sizeCode', 'sellcodeCode and itemcolourRef and sizeCode')
		    RETURN -1
		END

		SELECT @itemcoloursize_id = sellcode.itemcoloursize_id,
		       @itemcolour_ref = itemcolour.itemcolour_ref,
		       @size_code =  itemcoloursize.size
		FROM   sellcode WITH(NOLOCK), itemcoloursize WITH(NOLOCK), itemcolour WITH(NOLOCK)
		WHERE  sellcode.sellcode_code = @sellcode_code
		 AND   sellcode.active_ind = 'Y'
		 AND   sellcode.itemcoloursize_id = itemcoloursize.itemcoloursize_id
		 AND   itemcoloursize.active_ind = 'Y'
		 AND   itemcoloursize.itemcolour_id = itemcolour.itemcolour_id
		 AND   itemcolour.active_ind = 'Y'
	    END
	END
	ELSE IF ISNULL(@barcode_code, '') <> ''
	BEGIN
	    IF NOT EXISTS (SELECT 1
			   FROM   itemcolourpp WITH(NOLOCK), itemcolour WITH(NOLOCK)
			   WHERE  itemcolourpp.barcode_code = @barcode_code
			    AND   itemcolourpp.active_ind = 'Y'
			    AND   itemcolourpp.itemcolour_id = itemcolour.itemcolour_id
			    AND   itemcolour.active_ind = 'Y')
	    BEGIN
		RAISERROR (57808, 16, 4, @barcode_code)
		RETURN -1
	    END
	    ELSE
	    BEGIN
		  -- Raise an error if the barcode_code and (itemcolour_ref and size_code) are specified.
		IF (ISNULL(@itemcolour_ref, '') <> ''
		AND ISNULL(@size_code, '') <> '')
		BEGIN
		    RAISERROR (57816, 16, 4, 'barcodeCode and itemcolourRef and sizeCode', 'barcodeCode or itemcolourRef and sizeCode')
		    RETURN -1
		END

		  -- If the barcodeCode AND itemcolour_ref and prepack_ref are specified, make
		  -- sure they match.
		IF  ISNULL(@itemcolour_ref, '') <> ''
		AND ISNULL(@prepack_ref, '') <> ''
		AND NOT EXISTS (SELECT 1
				FROM   itemcolourpp WITH(NOLOCK), itemcolour WITH(NOLOCK)
				WHERE  itemcolourpp.barcode_code = @barcode_code
		 		AND   itemcolourpp.active_ind = 'Y'
		 		AND   itemcolourpp.itemcolour_id = itemcolour.itemcolour_id
		 		AND   itemcolour.active_ind = 'Y'
				AND   itemcolour.itemcolour_ref = @itemcolour_ref
				AND   itemcolourpp.prepack_ref = @prepack_ref)
		BEGIN
		    RAISERROR (57817, 16, 4, 'barcodeCode and itemcolourRef and prepackRef', 'barcodeCode and itemcolourRef and prepackRef', 'barcodeCode and itemcolourRef and prepackRef')
		    RETURN -1
		END

		SELECT @barcode_code = itemcolourpp.barcode_code,
		       @prepack_ref = itemcolourpp.prepack_ref,
		       @itemcolour_ref = itemcolour.itemcolour_ref
		FROM   itemcolourpp WITH(NOLOCK), itemcolour WITH(NOLOCK)
		WHERE  itemcolourpp.barcode_code = @barcode_code
		 AND   itemcolourpp.active_ind = 'Y'
		 AND   itemcolourpp.itemcolour_id = itemcolour.itemcolour_id
		 AND   itemcolour.active_ind = 'Y'
	    END
	END
	ELSE IF ISNULL(@itemcolour_ref, '') <> ''
	BEGIN
	    IF NOT EXISTS (SELECT 1
		  	   FROM	  itemcolour WITH(NOLOCK)
			   WHERE  itemcolour.itemcolour_ref = @itemcolour_ref
			    AND   itemcolour.active_ind = 'Y')
	    BEGIN
		RAISERROR (57809, 16, 4, @itemcolour_ref)
		RETURN -1
	    END 
	

	    IF ISNULL(@size_code, '') <> ''
	    BEGIN
		IF ISNULL(@prepack_ref, '') <> ''
		BEGIN
		    RAISERROR (57816, 16, 4, 'itemcolourRef and sizeCode and itemcolourRef and prepackRef', 'itemcolourRef and sizeCode or itemcolourRef and prepackRef')
		    RETURN -1
		END

	    	IF NOT EXISTS (SELECT 1
			   FROM   itemcoloursize WITH(NOLOCK), itemcolour WITH(NOLOCK)
			   WHERE  itemcoloursize.size = @size_code
			    AND   itemcoloursize.itemcolour_id = itemcolour.itemcolour_id
			    AND   itemcolour.itemcolour_ref = @itemcolour_ref
			    AND   itemcoloursize.active_ind = 'Y')
	    	BEGIN
		    RAISERROR (57810, 16, 4, @size_code)
		    RETURN -1
	    	END
	    	ELSE
	    	BEGIN
		    SELECT @itemcoloursize_id = itemcoloursize.itemcoloursize_id
		    FROM   itemcoloursize WITH(NOLOCK), itemcolour WITH(NOLOCK)
		    WHERE  itemcoloursize.size = @size_code
		     AND   itemcoloursize.itemcolour_id = itemcolour.itemcolour_id
		     AND   itemcolour.itemcolour_ref = @itemcolour_ref
		     AND   itemcoloursize.active_ind = 'Y'
		     AND   itemcolour.active_ind = 'Y'
	        END
	    END
	    ELSE IF ISNULL(@prepack_ref, '') <> ''
	    BEGIN
	        IF NOT EXISTS (SELECT 1
				FROM   itemcolourpp WITH(NOLOCK), itemcolour WITH(NOLOCK)
				WHERE  itemcolourpp.itemcolour_id = itemcolour.itemcolour_id
				 AND   itemcolour.itemcolour_ref = @itemcolour_ref
				 AND   itemcolourpp.prepack_ref = @prepack_ref
				 AND   itemcolourpp.active_ind = 'Y')
	    	BEGIN
		    RAISERROR (57811, 16, 4, @prepack_ref)
		    RETURN -1
	    	END
	    	ELSE
	    	BEGIN
		    SELECT @barcode_code = itemcolourpp.barcode_code,
			   @itemcolour_ref = itemcolour.itemcolour_ref
		    FROM itemcolourpp WITH(NOLOCK), itemcolour WITH(NOLOCK)
		    WHERE itemcolourpp.prepack_ref = @prepack_ref
		    AND itemcolourpp.itemcolour_id = itemcolour.itemcolour_id
		    AND itemcolour.itemcolour_ref = @itemcolour_ref
		    AND itemcolourpp.active_ind = 'Y'
		    AND itemcolour.active_ind = 'Y'
	    	END
	    END
	END
	
	IF ISNULL(@itemcoloursize_id, '') = '' AND ISNULL(@barcode_code, '') = ''
	BEGIN
	    IF ISNULL(@itemcolour_ref, '') <> ''
	    BEGIN
		RAISERROR (57813, 16, 4)
	 	RETURN -1
	    END
	    ELSE
	    BEGIN
		RAISERROR (57812, 16, 4)
		RETURN -1
	    END
	END
	
	SELECT @customersite_id = customersite.customersite_id
	FROM customersite WITH(NOLOCK)
	WHERE customersite.customer_code = @customer_id
	AND customersite.location_ref = @location_ref
	AND customersite.active_ind = 'Y'
	
	
		
	IF ISNULL(@customersite_id, '') = ''
	BEGIN
		-- If it exists, it must be set to inactive.
	    IF EXISTS (SELECT 1
		       FROM   customersite WITH(NOLOCK)
		       WHERE  customersite.customer_code = @customer_id
			AND   customersite.location_ref  = @location_ref)
	    BEGIN
		RAISERROR (57807, 16, 4, @location_ref)
		RETURN -1
	    END
	    ELSE  -- Otherwise it is an incorrect locationRef
	    BEGIN
	    	RAISERROR (57805, 16, 4, @location_ref)
	    	RETURN -1
	    END
	END
	
	IF @order_quantity <= 0
	BEGIN
	    RAISERROR (57814, 16, 4)
	    RETURN -1
	END

	IF @sell_price_per_unit < 0
	BEGIN
	    RAISERROR (57815, 16, 4)
	    RETURN -1
	END

	SET @sales_date = ISNULL(@sales_date, GETDATE())

    -- If the status specified is 'Pending' set approved_ind to 'N',
    -- otherwise, set approved_ind to 'Y'
	IF ISNULL(@status, 'Approved') = 'Pending'
    BEGIN
	    SET @approved_ind = 'N'
	END
    ELSE
    BEGIN
        SET @approved_ind = 'Y'
    END
	
    -- get the price method code (used for freight and item price calculations).
	SELECT @pricemethod_code = location.ret_pricemethodtype_code
	FROM location WITH(NOLOCK)
	WHERE location.location_code = @store_code

	-- Validate customertype_code if specified
	IF IsNull(@customertype_code,'') <> ''
	BEGIN
		IF NOT EXISTS (SELECT 1 FROM customertype WITH(NOLOCK) WHERE customertype_id = @customertype_code AND active_ind = 'Y')
		BEGIN
			RAISERROR (57832, 16, 4)
			RETURN -1
		END
		
		-- Check if discountcustomer exists and active
		SELECT	@discountcustomer_code = IsNull(dc.discountcustomer_code,''),
				@discount_description = IsNull(dc.description,'')
		  FROM	customertype ct WITH(NOLOCK)
		INNER JOIN discountcustomer dc WITH(NOLOCK) ON dc.discountcustomer_code = ct.discountcustomer_code
		 WHERE	ct.customertype_id = @customertype_code
		   AND	dc.active_ind = 'Y'
		   
		-- If discountcustomer code does not exist, set customertype code to empty.
		IF IsNull(@discountcustomer_code,'') = ''
		BEGIN
			SELECT @customertype_code = ''
		END
	END
	
	IF ISNULL(@originating_store_code, '') <> ''
	BEGIN
	    IF NOT EXISTS (SELECT 1
				FROM store WITH(NOLOCK)
				WHERE store_code = @originating_store_code
				AND active_ind = 'Y')
		BEGIN
			RAISERROR (57835, 16, 4, @originating_store_code)
			RETURN -1
		END
	END 
	
	-- If no salesorder code is provided, create a new salesorder record.
	-- If creating a new salesorder.
	IF ISNULL(@create_new_salesorder,'N') = 'Y' -- ISNULL(@salesorder_code, '') = ''
	BEGIN
		IF NOT EXISTS (SELECT 1
				FROM store WITH(NOLOCK)
				WHERE store_code = @store_code
				AND active_ind = 'Y')
		BEGIN
			RAISERROR (57803, 16, 4, @store_code)
			RETURN -1
		END
--		Excluded: Task 015670 Put on hold.
        -- Check that shipregionmethod_id is valid if specified.
--        IF ISNULL(@shipregionmethod_id, '') <> ''
--        BEGIN
--            IF NOT EXISTS (SELECT 1
--                             FROM shipregionmethod WITH(NOLOCK)
--		                    WHERE shipregionmethod_id = @shipregionmethod_id
--                              AND ISNULL(active_ind,'N') = 'Y')
--            BEGIN
                -- shipregionmethod_id was specified but not valid.
--                RAISERROR(57829, 16, 4, @shipregionmethod_id)
--                RETURN -1
--            END
--        END
		
		-- Get system config RDWS_NONUNIQUE_EXT_ORDER_CODE		
		SELECT	@RDWS_NONUNIQUE_EXT_ORDER_CODE = IsNull(entry_value,'')
		  FROM	systemconfig WITH(NOLOCK) 
		 WHERE	systemconfig_code = 'RDWS_NONUNIQUE_EXT_ORDER_CODE'
		   AND	active_ind = 'Y'    
		
		-- 018416: Check system config RDWS_NONUNIQUE_EXT_ORDER_CODE
		-- If allow non-unique external order codes, skip validation
		-- By default always enforce unique external order code
		IF ISNULL(@RDWS_NONUNIQUE_EXT_ORDER_CODE,'') = '' OR @RDWS_NONUNIQUE_EXT_ORDER_CODE = 'N'
		BEGIN
        -- 016030: Check for existing duplicate sales order (@external_order_code already 
        -- present in salesorder table).
        IF ISNULL(@external_order_code,'') <> ''
        BEGIN
            -- There 'should' only ever be one, but it's not impossible that there
            -- are more. We will use the first one we find in the error message.
            SELECT TOP 1 @duplicate_salesorder_code = salesorder_code
              FROM salesorder WITH(NOLOCK, INDEX=salesorder_1)
             WHERE external_order_code = @external_order_code
 
            -- Found a matching sales order. This one is a duplicate.
            IF @@ROWCOUNT > 0
            BEGIN 
                RAISERROR(57830, 16, 4, @external_order_code, @duplicate_salesorder_code)
                RETURN -1
				END
            END
        END

		SELECT @lead_time_days = ISNULL(std_lead_time_days,0.0)
          FROM store WITH(NOLOCK)
         WHERE store_code = @store_code

		  -- set the delivery date to the sales date, if the sales date is in
		  -- the future, otherwise set it to the current date, unless it is
		  -- already specified.
		IF @sales_date > GETDATE()
		BEGIN
		    SET @delivery_due_date_time = ISNULL(@delivery_due_date_time, DATEADD(day, @lead_time_days, @sales_date))
		END
	  	ELSE
		BEGIN
		    SET @delivery_due_date_time = ISNULL(@delivery_due_date_time, DATEADD(day, @lead_time_days, GETDATE()))
		END

		IF @delivery_due_date_time < @sales_date
		BEGIN
			RAISERROR (57801, 16, 4)
			RETURN -1
		END
	
		IF NOT EXISTS (SELECT 1
				FROM supplychannel WITH(NOLOCK)
				WHERE supplychannel_code = @supplychannel_code
				AND active_ind = 'Y' )
		BEGIN
			RAISERROR (57802, 16, 4, @supplychannel_code)
			RETURN -1
		END
	
		--IF NOT EXISTS (SELECT 1
		--		FROM customer
		--		WHERE customer_id = @customer_id
		--		AND customer_status_ind = 'A')
		--BEGIN
		--	RAISERROR (57804, 16, 4)
		--	RETURN -1
		--END

		--IF NOT EXISTS (SELECT 1
		--		FROM customersite
		--		WHERE customer_code = @customer_id
		--		AND location_ref = @location_ref)
		--BEGIN
		--	RAISERROR (57805, 16, 4)
		--	RETURN -1
		--END

--		Excluded shipregionemthod: Task 015670 Put on hold. No need for check.
        -- If no @shipregionmethod_id is specified, use the old method of calculating
        -- the freight based on the fixed itemcoloursize.
--        IF ISNULL(@shipregionmethod_id,'') = ''
--        BEGIN
            -- Calculate the freight amount.
            SELECT @freight_ics_id = ics.itemcoloursize_id
              FROM fixeditemcoloursize fics WITH(NOLOCK)
             INNER JOIN itemcoloursize ics WITH(NOLOCK) ON fics.itemcoloursize_id = ics.itemcoloursize_id
             WHERE ISNULL(ics.active_ind,'') = 'Y'
               AND fics.fixeditem_type = @freight_fixeditem_type

            SELECT @freight_amount = p.current_price
              FROM price p WITH(NOLOCK)
             INNER JOIN itemcoloursize ics WITH(NOLOCK) ON p.itemcolour_id = ics.itemcolour_id
             WHERE ics.itemcoloursize_id  = @freight_ics_id
               AND p.pricemethod_code     = @pricemethod_code
               AND p.start_date_time      <= GETDATE() 
               AND p.expiry_date_time     >= GETDATE() 
               AND p.wholesale_retail_ind = 'R'
  --      END
	
		-- This is a new order. Set Multiple delivey ind to 'N'
		SET @multiple_delivery_ind = 'N'

		SELECT @currency_code = location.currency_code
		  FROM location WITH(NOLOCK)
		 WHERE location.location_code = @store_code

		INSERT salesorder (
			salesorder_code,
			customer_code,
			store_code,
			approved_ind,
			cancelled_ind,
			printed_ind,
			completed_ind,
			sales_date,
			insert_user,
			insert_date_time,
			currency_code,
			delivery_due_date_time,
			supplychannel_code,
			salesorder_type_ind,
			multiple_delivery_ind,
            freight_amount,
--			shipregionmethod_id,
            external_order_code,
            customertype_id,
            discountcustomer_code,
            originating_store_code )
		SELECT 	@salesorder_code,
			@customer_id,
			@store_code,
			@approved_ind,
			'N',
			'N',
			'N',
			@sales_date,
			@user_code,
			GETDATE(),
			@currency_code,
			@delivery_due_date_time,
			@supplychannel_code,
			'C',
			@multiple_delivery_ind,
            @freight_amount,
--			@shipregionmethod_id,
            @external_order_code,
            @customertype_code,
            @discountcustomer_code,
            @originating_store_code
            
		IF ISNULL(@delivery_instructions,'') <> ''
		BEGIN
			-- Check if salesorderdeliv_code exists (need to have the code to create record)
			IF ISNULL(@salesorderdelivery_code,'') = ''
			BEGIN
				-- Raise an error 
				-- RAISERROR(57832, 16, 4) NEW ERROR NUMBER REQUIRED
				RAISERROR(57836, 16, 4)
				RETURN -1
			END
			
			-- Add delivery instructions
			INSERT salesorderdelivery
			(
				salesorderdelivery_code,
				salesorder_code,
				delivery_instructions
			)
			SELECT
				@salesorderdelivery_code,
				@salesorder_code,
				@delivery_instructions
		 END
           
	END
	
	-- Set the @delivery_due_date_time (otherwise it wont be set in the output
	-- when a sales order line is added)
	SELECT @delivery_due_date_time = delivery_due_date_time
	FROM   salesorder WITH(NOLOCK)
	WHERE  salesorder_code = @salesorder_code

	-- Set @multiple_delivery_ind to 'Y' if there are multiple delivery
	-- sites in the order.
	IF EXISTS (SELECT 1
		   FROM   salesorderline WITH(NOLOCK), customersite WITH(NOLOCK)
		   WHERE  salesorder_code = @salesorder_code
		    AND   salesorderline.delivery_customersite_id = customersite.customersite_id
		    AND   customersite.location_ref <> @location_ref)
	BEGIN
	    -- update the salesorder.
	    UPDATE salesorder
	    SET multiple_delivery_ind = 'Y'
	    WHERE salesorder_code = @salesorder_code
	END
	-- update the output parameters
	SELECT @multiple_delivery_ind = multiple_delivery_ind,
           @freight_amount = freight_amount
	FROM   salesorder WITH(NOLOCK)
	WHERE  salesorder_code = @salesorder_code

	-- only create a new ID if none provided in the input.
	IF ISNULL(@salesorderline_id,'') = ''
	BEGIN
		-- In the new way of calling this stored procedure, this line will not be executed.
		-- it is here to provide some backward compatibiltiy.
		EXEC @return = up_nextid @datacentre_code, @salesorderline_id OUTPUT
	END
	ELSE 
	BEGIN
		IF EXISTS (SELECT 1 FROM salesorderline WITH(NOLOCK) WHERE salesorderline_id = @salesorderline_id)
		BEGIN
			-- This should never happen.
			RAISERROR(57831, 16, 4, @salesorderline_id)
			RETURN -1
		END
	END

	SELECT @scalerating_id = vpmc.scalerating_id
	FROM valpricemethodcomp vpmc, valpricemethod vpm, itemcolour ic
	WHERE ic.itemcolour_ref = @itemcolour_ref
	AND vpm.valuation_id = ic.current_valuation_id 
	AND vpmc.valpricemethod_id = vpm.valpricemethod_id
	AND vpm.pricemethod_code = @pricemethod_code
	AND vpmc.source_ind = 'S'
	AND vpmc.scale_type_ind = 'G'

    -- Get the tax percentage based on the scalerating unless the
    -- override_tax_pct_ind option is set to 'Y'. This option allows the tax
    -- percentage to be set to 0% for sales with a destination which is not the
    -- same country as the country of origin.
    IF ISNULL(@override_tax_pct_ind, 'N') <> 'Y'
    BEGIN
		SELECT @tax_pct = ssr.rate_multiplier
		FROM scalesettingrate ssr, scalesetting ss
		WHERE ssr.scalerating_id = @scalerating_id
		AND ssr.scalesetting_id = ss.scalesetting_id
		AND ss.eff_date_from <= @sales_date
		AND ss.eff_date_to >= @sales_date
    END
    ELSE
    BEGIN
        SELECT @tax_pct = ISNULL(@tax_pct,0.00)
    END

    SELECT @tax_amount = (@order_quantity * @sell_price_per_unit * @tax_pct) / (100 + @tax_pct)

	-- Apply discount if customertype was specified
	IF IsNull(@customertype_code,'') <> ''
	BEGIN

		EXEC up_salesorderline_calculate	@store_code,
											@customertype_code, 
											@sellcode_code  OUTPUT, 
											@barcode_code  OUTPUT, 
											@itemcolour_ref  OUTPUT, 
											@size_code  OUTPUT, 
											@prepack_ref  OUTPUT, 
											@order_quantity, 
											@list_price_per_unit  OUTPUT,
											@sell_price_per_unit  OUTPUT,
											@eff_price_overflow  OUTPUT,
											@tax_pct  OUTPUT,
											@tax_amount  OUTPUT,
											@override_tax_pct_ind
	END
	ELSE
	BEGIN
		-- Default to list price per unit = sell price per unit and no price overflow.
		SELECT
			@list_price_per_unit = @sell_price_per_unit,
			@eff_price_overflow = 0
			
	END

	INSERT salesorderline (
			salesorderline_id,
			salesorder_code,
			itemcoloursize_id,
			barcode_code,
			order_quantity,
			list_price_per_unit,
			sell_price_per_unit,
			eff_price_overflow,
			commission_per_unit,
			tax_pct,
			tax_amount,
			delivery_customersite_id,
			quantity_allocated,
			customer_discount_voucher,
			deliver_after_date )
	SELECT 	@salesorderline_id,
		@salesorder_code,
		@itemcoloursize_id,
		@barcode_code,
		@order_quantity,
		IsNull(@list_price_per_unit,@sell_price_per_unit),
		@sell_price_per_unit,
		IsNull(@eff_price_overflow,0),
		0.0,
		@tax_pct,
		@tax_amount,
		@customersite_id,
		0,
		@customer_discount_voucher,
		@deliver_after_date

	-- Check if item is a freight item, if so, update sales order freight total
	IF EXISTS (SELECT 1 FROM systemconfig WITH(NOLOCK) WHERE systemconfig_code = 'web_legacy_mode' AND entry_value = 'N')
	BEGIN
		IF EXISTS (SELECT 1 FROM shipmethod WITH(NOLOCK) WHERE itemcoloursize_id = 	@itemcoloursize_id)
		BEGIN
			UPDATE	salesorder
			   SET	freight_amount = @sell_price_per_unit
			 WHERE	salesorder_code = @salesorder_code
			SELECT @freight_amount = @sell_price_per_unit
		END
	END	
	GO
