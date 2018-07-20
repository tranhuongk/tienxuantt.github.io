<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/bookshop/book">
        <html>
            <head>
                <title>XSL tutorial</title>
            </head>
        </html>
        <body>
            <ul>
                <li>tên khóa học: <xsl:value-of select="title" /></li>
                <li>tác giả: <xsl:value-of select="author" /></li>
                <li>số trang: <xsl:value-of select="pages" /></li>
                <xsl:if test="weight &gt; 400">
                    <li>
                        trọng lượng:    <xsl:value-of select="weight" />
                                        <xsl:value-of select="weight/@units" />
                    </li>
                </xsl:if>
                <li>
                    chú ý:
                    <xsl:choose>
                        <xsl:when test="weight/@units = 'gram'">
                        vận chuyển có phí
                        </xsl:when>
                        <xsl:otherwise>
                            vận chuyển miễn phí
                        </xsl:otherwise>
                    </xsl:choose>
                </li>
            </ul>
        </body>
        
    </xsl:template>
</xsl:stylesheet>